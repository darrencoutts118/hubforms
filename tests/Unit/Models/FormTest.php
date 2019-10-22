<?php

namespace Tests\Unit\Models;

use App\Models\Field;
use App\Models\Form;
use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    public function testItGeneratesAUuidTest()
    {
        // given a new form
        $form = factory(Form::class)->create();

        // it generates its own uuid
        $this->assertNotEmpty($form->uuid);
    }

    public function testItDoesNotChangeUuidWhenUpdating()
    {
        // given a new form
        $form = factory(Form::class)->create();

        // that has a uuid when it is created
        $uuid = $form->uuid;

        // if we change the form
        $form->title = 'A new title';

        // the uuid should be the same
        $form = $form->fresh();
        $this->assertEquals($uuid, $form->uuid);
    }

    public function testAFormHasSubmissions()
    {
        // given a new form
        $form = factory(Form::class)->create();

        // which has some fields
        factory(Field::class, 3)->create(['form_id' => $form->id]);

        // that has a submission
        $submission = new Submission();
        $submission->form_id = $form->id;
        $submission->save();

        // the submission can be retrived from the form
        $this->assertCount(1, $form->submissions);
    }

    public function testItHasAConfirmationText()
    {
        // given a new form
        $form = factory(Form::class)->create();

        // which has some fields
        factory(Field::class, 3)->create(['form_id' => $form->id]);

        // that has a submission
        $submission = new Submission();
        $submission->form_id = $form->id;
        $submission->save();

        // its confirmation text equals what is stored in the database
        $this->assertEquals($form->confirmation_text, $form->confirmation);
    }

    public function testItHasADefaultConfirmationText()
    {
        // given a new form
        $form = factory(Form::class)->create(['confirmation_text' => null]);

        // its confirmation text equals what is stored in the database
        $this->assertEquals('You have successfully submitted the form.', $form->confirmation);
    }
}
