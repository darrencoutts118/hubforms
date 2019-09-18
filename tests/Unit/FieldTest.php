<?php

namespace Tests\Unit;

use App\Models\Field;
use App\Models\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_its_the_first_item_it_is_order_one()
    {
        // given a form
        $form = factory(Form::class)->create();

        // when a field is created
        $field = factory(Field::class)->create(['form_id' => $form->id]);

        // it should be order one
        $field = $field->fresh();
        $this->assertEquals(1, $field->order);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_when_a_field_is_created_its_order_is_the_next_in_suequence()
    {
        // given a form
        $form = factory(Form::class)->create();

        // when a field is created
        factory(Field::class, 5)->create(['form_id' => $form->id]);

        // it should be order one
        $field = Field::latest('id')->first();
        $this->assertEquals(5, $field->order);
    }
}
