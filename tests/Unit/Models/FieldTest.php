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
    public function testIfItsTheFirstItemItIsOrderOne()
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
    public function testWhenAFieldIsCreatedItsOrderIsTheNextInSuequence()
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

    public function testAFieldCanBeMovedUp()
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

    public function testAFieldCanBeMovedDown()
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

    public function testTheTopItemCantBeMovedAnyHigher()
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

    public function testTheBottomItemCantBeMovedAnyLower()
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

    public function testTheOrderCanBeRetrived()
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

    public function testFieldBelongsToAForm()
    {
        // given a form
        $form = factory(Form::class)->create();

        // that has a field
        $field = factory(Field::class)->create(['form_id' => $form->id]);

        // the field belongs to the form
        $this->assertNotNull($field->form);
        $this->assertEquals($form->id, $field->form->id);
    }
}
