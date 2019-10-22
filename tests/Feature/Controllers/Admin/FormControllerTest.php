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

    public function testAnAuthorizedUserCanReadTheListOfResources()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with multiple resources
        factory(Form::class, 5)->make();

        // i visit
        $response = $this->get(route($this->routePrefix . '.index'));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.forms.index');

        // and i see
        //$response->assertSee();
    }

    /*public function testAnUnauthorizedUserCanNotReadTheListOfResources()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with multiple resources
        factory(Form::class, 5)->make();

        // i visit
        $response = $this->get(route($this->routePrefix . '.index'));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }*/

    public function testANonLoggedInUserCanNotReadTheListOfResources()
    {
        // without logging in

        // with multiple resources
        factory(Form::class, 5)->make();

        // i visit
        $response = $this->get(route($this->routePrefix . '.index'));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function testAnAuthorizedUserCanReadAnInvididualResource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->create();

        // i visit
        $response = $this->get(route($this->routePrefix . '.show', $resource));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.forms.show');

        // and i see
        //$response->assertSee();
    }

    /*public function testAnUnauthorizedUserCanNotReadAnInvididualResource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // with a resource
        $resource = factory(Form::class)->create();

        // i visit
        $response = $this->get(route($this->routePrefix . '.show', $resource));

        // i am redirected to the login
        $response->assertRedirect(route('login'));

    }*/

    public function testANonLoggedInUserCanNotReadAnInvididualResource()
    {
        // without logging in

        // with a resource
        $resource = factory(Form::class)->create();

        // i visit
        $response = $this->get(route($this->routePrefix . '.show', $resource));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function testAnAuthorizedUserCanSeeTheFormToCreateAResource()
    {
        // as a logged in, authorized user
        $this->actingAs(factory(User::class)->create());

        // i visit
        $response = $this->get(route($this->routePrefix . '.create'));

        // response is 200
        $response->assertOk();

        // view is
        $response->assertViewIs('admin.forms.create');

        // and i see
        //$response->assertSee();
    }

    /*public function testAnUnauthorizedUserCanNotSeeTheFormToCreateAResource()
    {
        // as a logged in, unauthorized user
        $this->actingAs(factory(User::class)->create());

        // i visit
        $response = $this->get(route($this->routePrefix . '.create'));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }*/

    public function testANonLoggedInUserCanNotSeeTheFormToCreateAResource()
    {
        // without logging in

        // i visit
        $response = $this->get(route($this->routePrefix . '.create'));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function testAnAuthorizedUserCanCreateAResource()
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

    /*public function testAnUnauthorizedUserCanNotCreateAResource()
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

    public function testANonLoggedInUserCanNotCreateAResource()
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

    public function testAnAuthorizedUserCanSeeTheFormToUpdateAResource()
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

    /*public function testAnUnauthorizedUserCanNotSeeTheFormToUpdateAResource()
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

    public function testANonLoggedInUserCanNotSeeTheFormToUpdateAResource()
    {
        // without logging in

        // with a resource
        $resource = factory(Form::class)->create();

        // i visit
        $response = $this->get(route($this->routePrefix . '.edit', $resource));

        // i am redirected to the login
        $response->assertRedirect(route('login'));
    }

    public function testAnAuthorizedUserCanUpdateAResource()
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

    /*public function testAnUnauthorizedUserCanNotUpdateAResource()
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

    public function testANonLoggedInUserCanNotUpdateAResource()
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

    public function testAnAuthorizedUserCanDeleteAResource()
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

    /*public function testAnUnauthorizedUserCanNotDeleteAResource()
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

    public function testANonLoggedInUserCanNotDeleteAResource()
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
