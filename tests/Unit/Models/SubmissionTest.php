<?php

namespace Tests\Unit\Models;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_a_submission_can_contain_metable_attributes()
    {
        // given a form
        $form = factory(Form::class)->create();

        // which has a submission
        $submission = new Submission;
        $submission->form()->associate($form);

        // form field values can be assigned to them
        $submission->blablabla = 'test';
        $submission->save();

        // and are stored in a table
        $this->assertDatabaseHas('submissions', ['form_id' => $form->id]);

        $this->assertDatabaseHas('submissions_meta', [
            'key'   => 'blablabla',
            'value' => 'test',
        ]);
    }

    public function test_a_submission_can_contains_meta()
    {
        // given a form
        $form = factory(Form::class)->create();

        // which has a submission
        $submission = new Submission;
        $submission->form()->associate($form);

        // form field values can be assigned to them
        $submission->blablabla = 'test';
        $submission->save();

        // and is accessible through the relationshup
        $this->assertNotEmpty($submission->metas);

        $this->assertEquals('test', $submission->metas[0]->value);
    }

    public function test_a_meta_value_can_be_fluently_retrieved()
    {
        // given a form
        $form = factory(Form::class)->create();

        // which has a submission
        $submission = new Submission;
        $submission->form()->associate($form);

        // form field values can be assigned to them
        $submission->blablabla = 'test';
        $submission->save();

        // and can be retrieved fluently
        $this->assertEquals('test', $submission->blablabla);

        // even after being stored in the database
        $form = $form->fresh();
        $this->assertEquals('test', $submission->blablabla);
    }
}
