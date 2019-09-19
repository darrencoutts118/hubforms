<?php

namespace Tests\Feature;

use App\Models\Field;
use App\Models\Form;
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
        // given a form
        $form = factory(Form::class)->create();

        // with two fields
        $fields = factory(Field::class, 2)->create(['form_id' => $form->id]);

        //
        $response = $this->post(route('admin.fields.order', ['direction' => 'up']), [
            'field' => $fields[0]->id,
        ]);

        $response->assertStatus(200);

        //
    }
}
