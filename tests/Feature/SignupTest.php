<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(LazilyRefreshDatabase::class);

test('homepage links to the signup form', function () {
    $this->get('/')->assertOk()->assertSee(route('signup'));
    $this->get('/signup')->assertOk()->assertSeeText('Full Name')->assertSeeText('Confirm Password');
});

test('signup creates an account that can log in', function () {
    $this->post('/signup', [
        'name' => 'New Explorer',
        'email' => 'explorer@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirectToRoute('login')
        ->assertSessionHas('status', 'Account created successfully. You can now log in.')
        ->assertSessionHasInput('email', 'explorer@example.com')
        ->assertSessionMissing('_old_input.password');

    $user = User::where('email', 'explorer@example.com')->sole();
    expect($user->name)->toBe('New Explorer')
        ->and(Hash::check('password123', $user->password))->toBeTrue();
    $this->assertGuest();
    $this->get('/login')->assertOk()->assertSeeText('Account created successfully. You can now log in.');
    $this->post('/login', ['email' => $user->email, 'password' => 'password123'])
        ->assertRedirect('/places');
    $this->assertAuthenticatedAs($user);
});

test('signup rejects invalid details without creating an account', function (array $changes, array $errors) {
    $details = array_replace([
        'name' => 'New Explorer',
        'email' => 'explorer@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ], $changes);

    $this->from('/signup')->post('/signup', $details)
        ->assertRedirectToRoute('signup')
        ->assertSessionHasErrors($errors)
        ->assertSessionMissing('_old_input.password')
        ->assertSessionMissing('_old_input.password_confirmation');

    $this->assertDatabaseCount('users', 0);
    $this->get('/signup')->assertOk()->assertSeeText(array_values($errors)[0]);
})->with([
    'required fields' => [
        ['name' => '', 'email' => '', 'password' => '', 'password_confirmation' => ''],
        ['name' => 'The name field is required.', 'email' => 'The email field is required.', 'password' => 'The password field is required.'],
    ],
    'invalid email' => [['email' => 'invalid'], ['email' => 'The email field must be a valid email address.']],
    'short password' => [['password' => 'short', 'password_confirmation' => 'short'], ['password' => 'The password field must be at least 8 characters.']],
    'confirmation mismatch' => [['password_confirmation' => 'different'], ['password' => 'The password field confirmation does not match.']],
    'long name' => [['name' => str_repeat('a', 256)], ['name' => 'The name field must not be greater than 255 characters.']],
    'long email' => [['email' => str_repeat('a', 244).'@example.com'], ['email' => 'The email field must not be greater than 255 characters.']],
]);

test('signup rejects an existing email without changing its password', function () {
    $user = User::factory()->create();

    $this->from('/signup')->post('/signup', [
        'name' => 'Another Explorer',
        'email' => $user->email,
        'password' => 'replacement123',
        'password_confirmation' => 'replacement123',
    ])->assertRedirectToRoute('signup')->assertSessionHasErrors(['email' => 'The email has already been taken.']);

    $this->assertDatabaseCount('users', 1);
    expect($user->fresh()->password)->toBe($user->password);
});

test('signup limits repeated submissions and keeps login available', function () {
    $this->freezeTime();

    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->from('/signup')->post('/signup', []);
    }

    $this->post('/signup', ['name' => 'Explorer', 'email' => 'explorer@example.com'])
        ->assertRedirectToRoute('signup')
        ->assertSessionHasErrors(['login' => 'Too many sign-up attempts. Please try again in 60 seconds.'])
        ->assertSessionHasInput('name', 'Explorer');

    $this->from('/login')->post('/login', [])
        ->assertSessionHasErrors(['password' => 'The password field is required.']);
    $this->assertDatabaseCount('users', 0);
});
