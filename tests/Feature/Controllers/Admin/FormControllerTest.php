<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Form as Resource;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $urlPrefix = 'admin.forms';

    public function test_an_authorized_user_can_read_the_list_of_resources()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with multiple resources
        factory(Resource::class, 5)->make();

        // visit
        $response = $this->get(route($this->urlPrefix . '.index'));

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
        factory(Resource::class, 5)->make();

        // visit
        $response = $this->get(route($this->urlPrefix . '.index'));

        // response is 401
        $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_read_the_list_of_resources()
    {
        // without logging in

        // with multiple resources
        factory(Resource::class, 5)->make();

        // visit
        $response = $this->get(route($this->urlPrefix . '.index'));

        // response is 401
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_read_an_invididual_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Resource::class)->make();

        // visit
        $response = $this->get(route($this->urlPrefix . '.show', $resource));

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
        $resource = factory(Resource::class)->make();

        // visit
        $response = $this->get(route($this->urlPrefix . '.show', $resource));

        // response is 401
        $response->assertRedirect(route('login'));

    }*/

    public function test_a_non_logged_in_user_can_not_read_an_invididual_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Resource::class)->make();

        // visit
        $response = $this->get(route($this->urlPrefix . '.show', $resource));

        // response is 401
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_see_the_form_to_create_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // visit
        $response = $this->get(route($this->urlPrefix . '.create'));

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
        $response = $this->get(route($this->urlPrefix . '.create'));

        // response is 401
        $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_see_the_form_to_create_a_resource()
    {
        // without logging in

        // visit
        $response = $this->get(route($this->urlPrefix . '.create'));

        // response is 401
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_create_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with new resource data
        $resource = factory(Resource::class)->make();

        // i post a new resource
        $response = $this->post(route($this->urlPrefix . '.store'), $resource->toArray());

        // redirected to the resource
        $response->assertRedirect(route($this->urlPrefix . '.show', Resource::first()));
    }

    /*public function test_an_unauthorized_user_can_not_create_a_resource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // i post a new resource
        $response = $this->post(route($this->urlPrefix . '.store'), factory(Resource::class)->make()->toArray());

        // response is 401
        $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_create_a_resource()
    {
        // without logging in

        // i post a new resource
        $response = $this->post(route($this->urlPrefix . '.store'), factory(Resource::class)->make()->toArray());

        // response is 401
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_see_the_form_to_update_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Resource::class)->create();

        // i visit
        $response = $this->get(route($this->urlPrefix . '.edit', $resource));

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
        $resource = factory(Resource::class)->create();

        // i visit
        $response = $this->get(route($this->urlPrefix . '.edit', $resource));

        // response is 401
        $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_see_the_form_to_update_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Resource::class)->create();

        // i visit
        $response = $this->get(route($this->urlPrefix . '.edit', $resource));

        // response is 401
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_update_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Resource::class)->create();

        // i submit to
        $response = $this->put(route($this->urlPrefix . '.update', $resource), factory(Resource::class)->make()->toArray());

        // response is 200
        $response->assertRedirect(route($this->urlPrefix . '.show', $resource));
    }

    /*public function test_an_unauthorized_user_can_not_update_a_resource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Resource::class)->create();

        // i submit to
        $response = $this->put(route($this->urlPrefix . '.update', $resource), factory(Resource::class)->make()->toArray());

        // response is 401
        $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_update_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Resource::class)->create();

        // i submit to
        $response = $this->put(route($this->urlPrefix . '.update', $resource), factory(Resource::class)->make()->toArray());

        // response is 401
        $response->assertRedirect(route('login'));
    }

    public function test_an_authorized_user_can_delete_a_resource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Resource::class)->create();

        // i send a delete request
        $response = $this->delete(route($this->urlPrefix . '.destroy', $resource));

        // response is 200
        $response->assertOk();
    }

    /*public function test_an_unauthorized_user_can_not_delete_a_resource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Resource::class)->create();

        // i send a delete request
        $response = $this->delete(route($this->urlPrefix . '.destroy', $resource));

        // response is 401
        $response->assertRedirect(route('login'));
    }*/

    public function test_a_non_logged_in_user_can_not_delete_a_resource()
    {
        // without logging in

        // with a resource
        $resource = factory(Resource::class)->create();

        // i send a delete request
        $response = $this->delete(route($this->urlPrefix . '.destroy', $resource));

        // response is 401
        $response->assertRedirect(route('login'));
    }
}
