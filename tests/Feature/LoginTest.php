<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

test('invalid credentials show an error and retain only the email', function () {
    $user = User::factory()->create();

    $response = $this->from('/login')->post('/login', [
        'email' => $user->email,
        'password' => 'incorrect-password',
    ]);

    $response->assertRedirectToRoute('login')
        ->assertSessionHasErrors(['email' => 'The email address or password is incorrect.'])
        ->assertSessionHasInput('email', $user->email)
        ->assertSessionMissing('_old_input.password');
    $this->assertGuest();
    $this->get('/login')->assertOk()
        ->assertSeeText('The email address or password is incorrect.')
        ->assertSee('value="'.$user->email.'"', false)
        ->assertDontSee('incorrect-password');
});

test('missing login fields show validation messages', function () {
    $response = $this->from('/login')->post('/login', []);

    $response->assertRedirect('/login')->assertSessionHasErrors([
        'email' => 'The email field is required.',
        'password' => 'The password field is required.',
    ]);
    $this->get('/login')->assertOk()
        ->assertSeeText('The email field is required.')
        ->assertSeeText('The password field is required.');
});

test('malformed email is rejected', function () {
    $this->from('/login')->post('/login', [
        'email' => 'invalid-email',
        'password' => 'password',
    ])->assertSessionHasErrors(['email' => 'The email field must be a valid email address.']);
});

test('login rate limit returns a helpful message to the form', function () {
    $this->freezeTime();

    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->from('/login')->post('/login', []);
    }

    $this->post('/login', ['email' => 'student@example.com', 'password' => 'secret'])
        ->assertRedirectToRoute('login')
        ->assertSessionHasErrors(['login' => 'Too many login attempts. Please try again in 60 seconds.'])
        ->assertSessionHasInput('email', 'student@example.com')
        ->assertSessionMissing('_old_input.password');

    $this->get('/login')->assertOk()
        ->assertSeeText('Too many login attempts. Please try again in 60 seconds.');
});

test('valid credentials still log in successfully', function () {
    $user = User::factory()->create();

    $this->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertRedirect('/places')
        ->assertSessionHasNoErrors();

    $this->assertAuthenticatedAs($user);
});
