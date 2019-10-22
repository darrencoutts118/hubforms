<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPromptsForAuthentication()
    {
        $response = $this->get(route('admin.forms.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIfYouAreAuthenticatedTheLoginPageRedirectsYou()
    {
        // as a logged in user
        $this->actingAs(factory(User::class)->create());

        $response = $this->get(route('login'));

        $response->assertRedirect(route('home'));
    }

    public function testIfYouVisitTheLoginPageWithoutBeingAuthenticated()
    {
        // without being a logged in user

        // i visit a non login page
        $response = $this->get(route('login'));

        $response->assertOk();
    }
}
