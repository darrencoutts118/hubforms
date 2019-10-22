<?php

namespace Tests\Feature\Controllers\Auth;

use App\User;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTheForgotPasswordPageIsShown()
    {
        // with a user
        $user = factory(User::class)->create();

        // i visit the forgot password page
        $response = $this->get(route('password.request'));

        // the page loads
        $response->assertOk();

        // i see an email box
        $response->assertSee('E-Mail Address');

        // i see a submit button
        $response->assertSee('Send Password Reset Link');
    }

    public function testIfAUserIsntFoundTheSubmissionErrors()
    {
        // with a user
        $user = factory(User::class)->create();

        // i submit a password reset request
        $response = $this->post(route('password.email'), ['email' => 'demo@demo.com']);

        // the page redirects back
        $response->assertRedirect();

        // the page has errors
        $response->assertSessionHasErrors('email');
    }

    public function testIfAUserIsFoundAnEmailIsSent()
    {
        Notification::fake();

        // with a user
        $user = factory(User::class)->create();

        // i submit a password reset request
        $response = $this->post(route('password.email'), ['email' => $user->email]);

        // the page redirects back
        $response->assertRedirect();

        // a notification is sent to me
        Notification::assertSentTo($user, ResetPasswordNotification::class);

        // and is stored in the database
        $this->assertDatabaseHas('password_resets', ['email' => $user->email]);
    }
}
