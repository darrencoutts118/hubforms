<?php

namespace Tests\Unit\Models;

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

        // it should have the next
        $field = Field::latest('id')->first();
        $this->assertEquals(5, $field->order);

        $field = factory(Field::class)->create(['form_id' => $form->id]);
        $this->assertEquals(6, $field->fresh()->order);
    }

    public function test_a_field_can_be_moved_up()
    {
        // given a form
        $form = factory(Form::class)->create();

        // that has two fields
        factory(Field::class, 2)->create(['form_id' => $form->id]);

        // the second field
        $field = Field::latest('id')->first();

        // can be moved above the first
        $field->moveOrderUp();

        // and therefore its order is 1
        $this->assertEquals(1, $field->fresh()->order);
    }

    public function test_a_field_can_be_moved_down()
    {
        // given a form
        $form = factory(Form::class)->create();

        // that has two fields
        factory(Field::class, 2)->create(['form_id' => $form->id]);

        // the first field
        $field = Field::oldest('id')->first();

        // can be moved below the second
        $field->moveOrderDown();

        // and therefore its order is 2
        $this->assertEquals(2, $field->fresh()->order);
    }

    public function test_the_top_item_cant_be_moved_any_higher()
    {
        // given a form
        $form = factory(Form::class)->create();

        // that has two fields
        factory(Field::class, 2)->create(['form_id' => $form->id]);

        // the first field
        $field = Field::oldest('id')->first();

        // cant be moved up
        $field->moveOrderUp();

        // and therefore its order is still 1
        $this->assertEquals(1, $field->fresh()->order);
    }

    public function test_the_bottom_item_cant_be_moved_any_lower()
    {
        // given a form
        $form = factory(Form::class)->create();

        // that has two fields
        factory(Field::class, 2)->create(['form_id' => $form->id]);

        // the second field
        $field = Field::latest('id')->first();

        // cant be moved down
        $field->moveOrderDown();

        // and therefore its order is still 1
        $this->assertEquals(2, $field->fresh()->order);
    }

    public function test_the_order_can_be_retrived()
    {
        // given a form
        $form = factory(Form::class)->create();

        // that has two fields
        factory(Field::class, 2)->create(['form_id' => $form->id]);

        // the second field
        $field = Field::latest('id')->first();

        // is then moved above the first
        $field->moveOrderUp();

        // therefore the order
        $fields = Field::ordered()->get();

        // is updated to reflect this
        $this->assertTrue($fields[0]->is($field));
    }
}
