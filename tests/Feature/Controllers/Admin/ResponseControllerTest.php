<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Field;
use App\Models\Form;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $routePrefix = 'admin.fields';

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
        factory(Field::class, 5)->make(['form_id' => $this->formid]);

        // i visit
        $response = $this->get(route($this->routePrefix . '.index', $this->formid));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.fields.index');

        // and i see
        //$response->assertSee();
    }

    /*public function test_an_unauthorized_user_can_not_read_the_list_of_resources()
    {
    // as a logged in, unauthorized user
    $this->actingAs(factory(User::class)->create());

    // with multiple resources
    factory(Field::class, 5)->make(['form_id' => $this->formid]);

    // i visit
    $response = $this->get(route($this->routePrefix . '.index', $this->formid));

    // i am redirected to the login
    $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_read_the_list_of_resources()
    {
        // without logging in

        // with multiple resources
        factory(Field::class, 5)->make(['form_id' => $this->formid]);

        // i visit
        $response = $this->get(route($this->routePrefix . '.index', $this->formid));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_see_the_form_to_create_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // i visit
        $response = $this->get(route($this->routePrefix . '.create', $this->form));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.fields.create');

        // and i see
        //$response->assertSee();
    }

    /*public function test_an_unauthorized_user_can_not_see_the_form_to_create_a_resource()
    {
    // as a logged in, unauthorized user
    $this->actingAs(factory(User::class)->create());

    // i visit
    $response = $this->get(route($this->routePrefix . '.create', $this->form));

    // i am redirected to the login
    $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_see_the_form_to_create_a_resource()
    {
        // without logging in

        // i visit
        $response = $this->get(route($this->routePrefix . '.create', $this->form));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_create_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with new resource data
        $resource = factory(Field::class)->make(['form_id' => $this->formid]);

        // i send a post request
        $response = $this->post(route($this->routePrefix . '.store', $this->form), $resource->toArray());

        // redirected to the resource
        $response->assertRedirect(route($this->routePrefix . '.index', $this->formid));

        // it is stored in the database
        $this->assertDatabaseHas(app(Field::class)->getTable(), $resource->toArray());
    }

    /*public function test_an_unauthorized_user_can_not_create_a_resource()
    {
    // as a logged in, unauthorized user
    $this->actingAs(factory(User::class)->create());

    // with new resource data
    $resource = factory(Field::class)->make(['form_id' => $this->formid]);

    // i send a post request
    $response = $this->post(route($this->routePrefix . '.store', $this->form), $resource->toArray());

    // i am redirected to the login
    $response->assertRedirect(route('login'));

    // it is not stored in the database
    $this->assertDatabaseMissing(app(Field::class)->getTable(), $resource->toArray());
    }*/

    public function test_a_non_logged_in_user_can_not_create_a_resource()
    {
        // without logging in

        // with new resource data
        $resource = factory(Field::class)->make(['form_id' => $this->formid]);

        // i send a post request
        $response = $this->post(route($this->routePrefix . '.store', $this->form), $resource->toArray());

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // it is not stored in the database
        $this->assertDatabaseMissing(app(Field::class)->getTable(), $resource->toArray());
    }

    public function test_an_authorized_user_can_see_the_form_to_update_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Field::class)->create(['form_id' => $this->formid]);

        // i visit
        $response = $this->get(route($this->routePrefix . '.edit', [$this->form, $resource]));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.fields.edit');

        // and i see
        //$response->assertSee();
    }

    /*public function test_an_unauthorized_user_can_not_see_the_form_to_update_a_resource()
    {
    // as a logged in, unauthorized user
    $this->actingAs(factory(User::class)->create());

    // with a resource
    $resource = factory(Field::class)->create(['form_id' => $this->formid]);

    // i visit
    $response = $this->get(route($this->routePrefix . '.edit', [$this->form, $resource]));

    // i am redirected to the login
    $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_see_the_form_to_update_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Field::class)->create(['form_id' => $this->formid]);

        // i visit
        $response = $this->get(route($this->routePrefix . '.edit', [$this->form, $resource]));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_update_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Field::class)->create(['form_id' => $this->formid]);

        // that i make changes to
        $new = factory(Field::class)->make(['form_id' => $this->formid]);

        // i submit to
        $response = $this->put(route($this->routePrefix . '.update', [$this->form, $resource]), $new->toArray());

        // response is 200
        $response->assertRedirect(route($this->routePrefix . '.index', $this->form));

        // the database record is updated
        $this->assertDatabaseHas(app(Field::class)->getTable(), $new->toArray());
    }

    /*public function test_an_unauthorized_user_can_not_update_a_resource()
    {
    // as a logged in, unauthorized user
    $this->actingAs(factory(User::class)->create());

    // with a resource
    $resource = factory(Field::class)->create(['form_id' => $this->formid]);

    // that i make changes to
    $new = factory(Field::class)->make(['form_id' => $this->formid]);

    // i submit to
    $response = $this->put(route($this->routePrefix . '.update', [$this->form, $resource]), $new->toArray());

    // i am redirected to the login
    $response->assertRedirect(route('login'));

    // the database record isnt updated
    $this->assertDatabaseHas(app(Field::class)->getTable(), $resource->toArray());
    }*/

    public function test_a_non_logged_in_user_can_not_update_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Field::class)->create(['form_id' => $this->formid]);

        // that i make changes to
        $new = factory(Field::class)->make(['form_id' => $this->formid]);

        // i submit to
        $response = $this->put(route($this->routePrefix . '.update', [$this->form, $resource]), $new->toArray());

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // the database record isnt updated
        $this->assertDatabaseHas(app(Field::class)->getTable(), $resource->toArray());
    }

    public function test_an_authorized_user_can_delete_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Field::class)->create(['form_id' => $this->formid]);

        // i send a delete request
        $response = $this->delete(route($this->routePrefix . '.destroy', [$this->form, $resource]));

        // response is a redirect
        $response->assertRedirect(route('admin.fields.index', $this->formid));

        // the record remains in the database
        $this->assertDatabaseMissing(app(Field::class)->getTable(), $resource->toArray());
    }

    /*public function test_an_unauthorized_user_can_not_delete_a_resource()
    {
    // as a logged in, unauthorized user
    $this->actingAs(factory(User::class)->create());

    // with a resource
    $resource = factory(Field::class)->create(['form_id' => $this->formid]);

    // i send a delete request
    $response = $this->delete(route($this->routePrefix . '.destroy', [$this->form, $resource]));

    // i am redirected to the login
    $response->assertRedirect(route('login'));

    // the record remains in the database
    $this->assertDatabaseHas(app(Field::class)->getTable(), $resource->toArray());
    }*/

    public function test_a_non_logged_in_user_can_not_delete_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Field::class)->create(['form_id' => $this->formid]);

        // i send a delete request
        $response = $this->delete(route($this->routePrefix . '.destroy', [$this->form, $resource]));

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // the record remains in the database
        $this->assertDatabaseHas(app(Field::class)->getTable(), $resource->toArray());
    }
}
