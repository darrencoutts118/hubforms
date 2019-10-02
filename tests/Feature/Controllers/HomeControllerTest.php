<?php

namespace Tests\Feature\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_i_am_not_logged_in_i_will_be_redirected()
    {
        // without logging in

        // i visit the home controller
        $response = $this->get(route('home'));

        // and am redirected to the login page
        $response->assertRedirect(route('login'));
    }

    public function test_if_i_am_logged_in_i_can_see_the_page()
    {
        // after logging in
        $this->actingAs(factory(User::class)->create());

        // i visit the home controller
        $response = $this->get(route('home'));

        // i get to see the page
        $response->assertOk();

        // the correct view is used
        $response->assertViewIs('home');
    }
}
