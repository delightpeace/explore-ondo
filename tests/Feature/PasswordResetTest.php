<?php

use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

uses(LazilyRefreshDatabase::class);

test('emailed code resets the password once and redirects to login', function () {
    Mail::fake();
    $user = User::factory()->create();
    config(['app.admin_emails' => [$user->email]]);

    $this->post('/forgot-password', ['email' => $user->email])->assertRedirectToRoute('password.reset');
    $code = null;
    Mail::assertSent(ResetPasswordEmail::class, function (ResetPasswordEmail $mail) use ($user, &$code) {
        $code = $mail->token;

        return $mail->hasTo($user->email) && Hash::check($code, Cache::get('password_reset_token_'.$user->email));
    });
    $this->get('/reset-password')->assertOk()->assertSeeText($user->email);

    $this->post('/reset-password', ['code' => $code, 'password' => 'new-password123', 'password_confirmation' => 'new-password123'])
        ->assertRedirectToRoute('login')->assertSessionHas('status', 'Your password has been reset. You can now log in.')
        ->assertSessionMissing('password_reset_email');
    expect(Hash::check('new-password123', $user->fresh()->password))->toBeTrue()
        ->and(Hash::check('password', $user->fresh()->password))->toBeFalse()
        ->and(Cache::has('password_reset_token_'.$user->email))->toBeFalse();

    $this->withSession(['password_reset_email' => $user->email])->from('/reset-password')
        ->post('/reset-password', ['code' => $code, 'password' => 'another-password', 'password_confirmation' => 'another-password'])
        ->assertSessionHasErrors('code');
    $this->post('/login', ['email' => $user->email, 'password' => 'new-password123'])->assertRedirect('/places');
    $this->assertAuthenticatedAs($user);
});

test('invalid or expired code cannot change password', function (bool $expired) {
    $this->freezeTime();
    $user = User::factory()->create();
    Cache::put('password_reset_token_'.$user->email, Hash::make('valid-code'), now()->addMinutes(10));
    if ($expired) {
        $this->travel(11)->minutes();
    }

    $this->withSession(['password_reset_email' => $user->email])->from('/reset-password')
        ->post('/reset-password', ['code' => $expired ? 'valid-code' : 'wrong', 'password' => 'new-password', 'password_confirmation' => 'new-password'])
        ->assertRedirect('/reset-password')->assertSessionHasErrors('code')
        ->assertSessionMissing('_old_input.password');

    expect(Hash::check('password', $user->fresh()->password))->toBeTrue();
})->with([false, true]);

test('reset validates required fields password length and confirmation', function (array $payload, array $fields) {
    $this->from('/reset-password')->post('/reset-password', $payload)
        ->assertRedirect('/reset-password')->assertSessionHasErrors($fields);
})->with([
    [[], ['code', 'password']],
    [['code' => 'code', 'password' => 'short', 'password_confirmation' => 'short'], ['password']],
    [['code' => 'code', 'password' => 'long-password', 'password_confirmation' => 'different'], ['password']],
]);

test('unknown email receives the same response without sending mail', function () {
    Mail::fake();

    $this->post('/forgot-password', ['email' => 'missing@example.com'])
        ->assertRedirectToRoute('password.reset')->assertSessionHas('password_reset_email', 'missing@example.com');

    Mail::assertNothingSent();
});

test('reset without an email in session requests a new code', function () {
    $this->get('/reset-password')->assertRedirectToRoute('password.request');
    $this->post('/reset-password', ['code' => 'code', 'password' => 'new-password', 'password_confirmation' => 'new-password'])
        ->assertRedirectToRoute('password.request');
});

test('reset attempts are throttled', function () {
    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post('/reset-password', []);
    }

    $this->post('/reset-password', [])->assertRedirectToRoute('password.reset')
        ->assertSessionHasErrors(['code' => 'Too many attempts. Please wait one minute and try again.']);
});
