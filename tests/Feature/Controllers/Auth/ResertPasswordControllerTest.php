<?php

namespace Tests\Feature\Controllers\Auth;

use App\User;
use Hash;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResertPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testThePasswordResetFormIsShown()
    {
        // with a user
        $user = factory(User::class)->create();

        // with a reset token
        $token = app(PasswordBroker::class)->createToken($user);

        // i visit the reset page
        $response = $this->get(route('password.reset', ['token' => $token, 'email' => $user->email]));

        // i get a 200 response
        $response->assertOk();

        // i see the email field
        $response->assertSee('E-Mail Address');

        // i see the email field has my email address
        $response->assertSee($user->email);

        // i see the password field
        $response->assertSee('Password');

        // i see the password confirm field
        $response->assertSee('Confirm Password');

        // the view is
        $response->assertViewIs('auth.passwords.reset');
    }

    public function testTheTokenMustBeValid()
    {
        // with a user
        $user = factory(User::class)->create();

        // with a reset token
        $token = app(PasswordBroker::class)->createToken($user);

        // i visit the reset page
        $response = $this->post(route('password.update'), [
            'token'                 => 'randomtoken',
            'email'                 => $user->email,
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // i get redirected
        $response->assertRedirect();

        // with errors
        $response->assertSessionHasErrors('email');
    }

    public function testTheEmailMustNotBeChanged()
    {
        // with a user
        $user = factory(User::class)->create();

        // with a reset token
        $token = app(PasswordBroker::class)->createToken($user);

        // i visit the reset page
        $response = $this->post(route('password.update'), [
            'token'                 => $token,
            'email'                 => 'demo@demo.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // i get redirected
        $response->assertRedirect();

        // with errors
        $response->assertSessionHasErrors('email');
    }

    public function testThePasswordMustMatch()
    {
        // with a user
        $user = factory(User::class)->create();

        // with a reset token
        $token = app(PasswordBroker::class)->createToken($user);

        // i visit the reset page
        $response = $this->post(route('password.update'), [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => 'password',
            'password_confirmation' => 'password1',
        ]);

        // i get redirected
        $response->assertRedirect();

        // with errors
        $response->assertSessionHasErrors('password');
    }

    public function testPasswordCanBeSet()
    {
        // with a user
        $user = factory(User::class)->create();

        // with a reset token
        $token = app(PasswordBroker::class)->createToken($user);

        // i visit the reset page
        $response = $this->post(route('password.update'), [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // i get redirected
        $response->assertRedirect(route('home'));

        // check the password has been changed
        $this->assertTrue(Hash::check('password', User::first()->password));

        // i have been logged in
        $this->assertAuthenticatedAs($user);
    }
}
