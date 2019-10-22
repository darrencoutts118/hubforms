<?php

namespace Tests\Feature\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTheRegistrationFormIsShown()
    {
        // i visit the registration page
        $response = $this->get(route('register'));

        // the page is loaded
        $response->assertOk();

        // i see the name field
        $response->assertSee('Name');

        // i see the email field
        $response->assertSee('E-Mail Address');

        // i see the password field
        $response->assertSee('Password');

        // i see the confirm password field
        $response->assertSee('Confirm Password');

        // the correct template is used
        $response->assertViewIs('auth.register');
    }

    public function testEmailAddressCantAlreadyExist()
    {
        // with a user
        $user = factory(User::class)->create();

        // i try to register a new user with the same email
        $new = factory(User::class)->make(['email' => $user->email]);

        // i visit the endpoint
        $response = $this->post(route('register'), $new->toArray() + ['password_confirmation' => $new->password]);

        // and should be redirected
        $response->assertRedirect();

        // with errors om the email
        $response->assertSessionHasErrors('email');

        // with input
        $response->assertSessionHasInput('email', $new->email);

        // and the user is not stored in the database
        $this->assertDatabaseMissing('users', $new->toArray());
    }

    public function testPasswordConfirmationMustMatch()
    {
        // i try to register a new user
        $new = factory(User::class)->make();

        // i visit the endpoint
        $response = $this->post(route('register'), $new->toArray() + ['password_confirmation' => 'password']);

        // and should be redirected
        $response->assertRedirect();

        // with errors om the email
        $response->assertSessionHasErrors('password');

        // and the user is not stored in the database
        $this->assertDatabaseMissing('users', $new->toArray());
    }

    public function testAUserCanBeCreated()
    {
        // i try to register a new user
        $new = factory(User::class)->make(['email_verified_at' => null]);

        // i visit the endpoint
        $response = $this->post(route('register'), $new->toArray() + ['password' => $new->password, 'password_confirmation' => $new->password]);

        // and should be redirected
        $response->assertRedirect();

        // there are no errors
        $response->assertSessionHasNoErrors();

        // and the user is not stored in the database
        $this->assertDatabaseHas('users', $new->toArray());
    }
}
