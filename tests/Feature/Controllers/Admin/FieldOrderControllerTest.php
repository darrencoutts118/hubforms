<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Field;
use App\Models\Form;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFeaturesCanBeMovedUp()
    {
        // as a logged in user
        $this->actingAs(factory(User::class)->create());

        // given a form
        $form = factory(Form::class)->create();

        // with two fields
        $fields = factory(Field::class, 2)->create(['form_id' => $form->id]);

        // when a post request is sent to the endpoint
        $response = $this->post(route('admin.fields.order', [$form, $fields[1]->id]), [
            'direction' => 'up',
        ]);

        $response->assertRedirect();

        // the order on the model is updated
        $this->assertEquals(1, $fields[1]->fresh()->order);
    }

    public function testFeaturesCanBeMovedDown()
    {
        // as a logged in user
        $this->actingAs(factory(User::class)->create());

        // given a form
        $form = factory(Form::class)->create();

        // with two fields
        $fields = factory(Field::class, 2)->create(['form_id' => $form->id]);

        // when a post request is sent to the endpoint
        $response = $this->post(route('admin.fields.order', [$form, $fields[0]->id]), [
            'direction' => 'down',
        ]);

        $response->assertRedirect();

        // the order on the model is updated
        $this->assertEquals(2, $fields[0]->fresh()->order);
    }

    public function testIfAnInvalidDirectionIsSpecifiedAbort()
    {
        // as a logged in user
        $this->actingAs(factory(User::class)->create());

        // given a form
        $form = factory(Form::class)->create();

        // with two fields
        $fields = factory(Field::class, 2)->create(['form_id' => $form->id]);

        // when a post request is sent to the endpoint
        $response = $this->post(route('admin.fields.order', [$form, $fields[0]->id]), [
            'direction' => 'something else',
        ]);

        $response->assertNotFound();

        // the order on the model is not updated
        $this->assertEquals(1, $fields[0]->fresh()->order);
    }

    public function testYouMustBeLoggedInToOrder()
    {
        // given a form
        $form = factory(Form::class)->create();

        // with two fields
        $fields = factory(Field::class, 2)->create(['form_id' => $form->id]);

        // when a post request is sent to the endpoint
        $response = $this->post(route('admin.fields.order', [$form, $fields[0]->id]), [
            'direction' => 'down',
        ]);

        // you are redirected to the login page
        $response->assertRedirect(route('login'));

        // the order on the model is not updated
        $this->assertEquals(1, $fields[0]->fresh()->order);
    }
}
