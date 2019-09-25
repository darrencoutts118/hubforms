<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Form;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $routePrefix = 'admin.forms';

    public function test_an_authorized_user_can_read_the_list_of_resources()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with multiple resources
        factory(Form::class, 5)->make();

        // visit
        $response = $this->get(route($this->routePrefix . '.index'));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.forms.index');

        // and i see
        //$response->assertSee();
    }

    /*public function test_an_unauthorized_user_can_not_read_the_list_of_resources()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with multiple resources
        factory(Form::class, 5)->make();

        // visit
        $response = $this->get(route($this->routePrefix . '.index'));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_read_the_list_of_resources()
    {
        // without logging in

        // with multiple resources
        factory(Form::class, 5)->make();

        // visit
        $response = $this->get(route($this->routePrefix . '.index'));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_read_an_invididual_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->make();

        // visit
        $response = $this->get(route($this->routePrefix . '.show', $resource));

        // response is 200
        $response->assertOk();

        // view is
        //$response->assertViewIs('admin.forms.show');

        // and i see
        //$response->assertSee();
    }

    /*public function test_an_unauthorized_user_can_not_read_an_invididual_resource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->make();

        // visit
        $response = $this->get(route($this->routePrefix . '.show', $resource));

        // i am redirected to the login
        $response->assertRedirect(route('login'));

    }*/

    public function test_a_non_logged_in_user_can_not_read_an_invididual_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Form::class)->make();

        // visit
        $response = $this->get(route($this->routePrefix . '.show', $resource));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_see_the_form_to_create_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // visit
        $response = $this->get(route($this->routePrefix . '.create'));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.forms.create');

        // and i see
        //$response->assertSee();
    }

    /*public function test_an_unauthorized_user_can_not_see_the_form_to_create_a_resource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // visit
        $response = $this->get(route($this->routePrefix . '.create'));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_see_the_form_to_create_a_resource()
    {
        // without logging in

        // visit
        $response = $this->get(route($this->routePrefix . '.create'));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_create_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with new resource data
        $resource = factory(Form::class)->make();

        // i send a post request
        $response = $this->post(route($this->routePrefix . '.store'), $resource->toArray());

        // redirected to the resource
        $response->assertRedirect(route($this->routePrefix . '.show', Form::first()));

        // it is stored in the database
        $this->assertDatabaseHas(app(Form::class)->getTable(), $resource->toArray());
    }

    /*public function test_an_unauthorized_user_can_not_create_a_resource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with new resource data
        $resource = factory(Form::class)->make();


        // i send a post request
        $response = $this->post(route($this->routePrefix . '.store'), $resource->toArray());

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // it is not stored in the database
        $this->assertDatabaseMissing(app(Form::class)->getTable(), $resource->toArray());
    }*/

    public function test_a_non_logged_in_user_can_not_create_a_resource()
    {
        // without logging in

        // with new resource data
        $resource = factory(Form::class)->make();

        // i send a post request
        $response = $this->post(route($this->routePrefix . '.store'), $resource->toArray());

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // it is not stored in the database
        $this->assertDatabaseMissing(app(Form::class)->getTable(), $resource->toArray());
    }

    public function test_an_authorized_user_can_see_the_form_to_update_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->create();

        // i visit
        $response = $this->get(route($this->routePrefix . '.edit', $resource));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.forms.edit');

        // and i see
        //$response->assertSee();
    }

    /*public function test_an_unauthorized_user_can_not_see_the_form_to_update_a_resource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->create();

        // i visit
        $response = $this->get(route($this->routePrefix . '.edit', $resource));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_see_the_form_to_update_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Form::class)->create();

        // i visit
        $response = $this->get(route($this->routePrefix . '.edit', $resource));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_update_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->create();

        // that i make changes to
        $new = factory(Form::class)->make();

        // i submit to
        $response = $this->put(route($this->routePrefix . '.update', $resource), $new->toArray());

        // response is 200
        $response->assertRedirect(route($this->routePrefix . '.show', $resource));

        // the database record is updated
        $this->assertDatabaseHas(app(Form::class)->getTable(), $new->toArray());
    }

    /*public function test_an_unauthorized_user_can_not_update_a_resource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->create();

        // that i make changes to
        $new = factory(Form::class)->make();

        // i submit to
        $response = $this->put(route($this->routePrefix . '.update', $resource), $new->toArray());

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // the database record isnt updated
        $this->assertDatabaseHas(app(Form::class)->getTable(), $resource->toArray());
    }*/

    public function test_a_non_logged_in_user_can_not_update_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Form::class)->create();

        // that i make changes to
        $new = factory(Form::class)->make();

        // i submit to
        $response = $this->put(route($this->routePrefix . '.update', $resource), $new->toArray());

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // the database record isnt updated
        $this->assertDatabaseHas(app(Form::class)->getTable(), $resource->toArray());
    }

    public function test_an_authorized_user_can_delete_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->create();

        // i send a delete request
        $response = $this->delete(route($this->routePrefix . '.destroy', $resource));

        // response is 200
        $response->assertOk();

        // the record remains in the database
        $this->assertDatabaseMissing(app(Form::class)->getTable(), $resource->toArray());
    }

    /*public function test_an_unauthorized_user_can_not_delete_a_resource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->create();

        // i send a delete request
        $response = $this->delete(route($this->routePrefix . '.destroy', $resource));

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // the record remains in the database
        $this->assertDatabaseHas(app(Form::class)->getTable(), $resource->toArray());
    }*/

    public function test_a_non_logged_in_user_can_not_delete_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Form::class)->create();

        // i send a delete request
        $response = $this->delete(route($this->routePrefix . '.destroy', $resource));

        // i am redirected to the login
        $response->assertRedirect(route('login'));

        // the record remains in the database
        $this->assertDatabaseHas(app(Form::class)->getTable(), $resource->toArray());
    }
}
