<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Form;
use App\Models\Submission;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $routePrefix = 'admin.submissions';

    public function setUp(): void
    {
        parent::setUp();

        $this->form   = factory(Form::class)->create();
        $this->formid = $this->form->id;
    }

    public function test_an_authorized_user_can_read_the_list_of_resources()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with multiple resources
        factory(Submission::class, 5)->make(['form_id' => $this->formid]);

        // i visit
        $response = $this->get(route($this->routePrefix . '.index', $this->formid));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.submissions.index');

        // and i see
        //$response->assertSee();
    }

    /*public function test_an_unauthorized_user_can_not_read_the_list_of_resources()
    {
    // as a logged in, unauthorized user
    $this->actingAs(factory(User::class)->create());

    // with multiple resources
    factory(Submission::class, 5)->make(['form_id' => $this->formid]);

    // i visit
    $response = $this->get(route($this->routePrefix . '.index', $this->formid));

    // i am redirected to the login
    $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_read_the_list_of_resources()
    {
        // without logging in

        // with multiple resources
        factory(Submission::class, 5)->make(['form_id' => $this->formid]);

        // i visit
        $response = $this->get(route($this->routePrefix . '.index', $this->formid));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_delete_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Submission::class)->create(['form_id' => $this->formid]);

        // i send a delete request
        $response = $this->delete(route($this->routePrefix . '.destroy', [$this->form, $resource]));

        // response is a redirect
        $response->assertRedirect(route('admin.submissions.index', $this->formid));

        // the record remains in the database
        $this->assertDatabaseMissing(app(Submission::class)->getTable(), $resource->toArray());
    }

    /*public function test_an_unauthorized_user_can_not_delete_a_resource()
    {
    // as a logged in, unauthorized user
    $this->actingAs(factory(User::class)->create());

    // with a resource
    $resource = factory(Submission::class)->create(['form_id' => $this->formid]);

    // i send a delete request
    $response = $this->delete(route($this->routePrefix . '.destroy', [$this->form, $resource]));

    // i am redirected to the login
    $response->assertRedirect(route('login'));

    // the record remains in the database
    $this->assertDatabaseHas(app(Submission::class)->getTable(), $resource->toArray());
    }*/

    public function test_a_non_logged_in_user_can_not_delete_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Submission::class)->create(['form_id' => $this->formid]);

        // i send a delete request
        $response = $this->delete(route($this->routePrefix . '.destroy', [$this->form, $resource]));

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // the record remains in the database
        $resource = $resource->toArray();
        unset($resource['meta_data']);
        
        $this->assertDatabaseHas(app(Submission::class)->getTable(), $resource);
    }
}
