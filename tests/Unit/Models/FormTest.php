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

    public function test_it_generates_a_uuidTest()
    {
        // given a new form
        $form = factory(Form::class)->create();

        // it generates its own uuid
        $this->assertNotEmpty($form->uuid);
    }

    public function test_it_does_not_change_uuid_when_updating()
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

    public function test_a_form_has_submissions()
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
}
