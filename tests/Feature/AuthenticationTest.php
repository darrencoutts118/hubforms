<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_prompts_for_authentication()
    {
        $response = $this->get(route('admin.forms.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_you_are_authenticated_the_login_page_redirects_you()
    {
        // as a logged in user
        $this->actingAs(factory(User::class)->create());

        $response = $this->get(route('login'));

        $response->assertRedirect(route('home'));
    }

    public function test_if_you_visit_the_login_page_without_being_authenticated()
    {
        // without being a logged in user

        // i visit a non login page
        $response = $this->get(route('login'));

        $response->assertOk();
    }
}
