<?php

namespace Tests\Feature\Controllers;

use App\Models\Field;
use App\Models\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_form_can_be_submitted()
    {
        // given a form
        $form = factory(Form::class)->create();

        // with a field
        $field = factory(Field::class)->create(['form_id' => $form->id]);

        // a submission can be made with valid details
        $response = $this->post(route('form.submit', $form), [
            $field->name => 'test value',
        ]);

        // the response should be OK
        $response->assertOk();

        // and a submission should appear in the databasee
        $this->assertDatabaseHas('submissions', [
            'form_id' => $form->id,
        ]);
    }
}
