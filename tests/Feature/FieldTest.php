<?php

namespace Tests\Feature;

use App\Models\Field;
use App\Models\Form;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_features_can_be_moved_up()
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

    public function test_features_can_be_moved_down()
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

    public function test_if_an_invalid_direction_is_specified_abort()
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

    public function test_you_must_be_logged_in_to_order()
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
