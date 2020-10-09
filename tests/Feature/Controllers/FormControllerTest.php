<?php

namespace Tests\Feature\Controllers;

use App\Mail\NewSubmissionEmail;
use App\Models\Field;
use App\Models\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FormControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAFormCanBeSubmitted()
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

    public function testAnEmailIsSentToNotificationAddressOnSubmission()
    {
        // mock mails, this prevents us actually sending emails
        Mail::fake();

        // given a form
        $form = factory(Form::class)->create(['notification' => 'notification@hubforms.io']);

        // with a field
        $field = factory(Field::class)->create(['form_id' => $form->id]);

        // a submission can be made with valid details
        $this->post(route('form.submit', $form), [
            $field->name => 'test value',
        ]);

        // an email is sent to the admin contact
        Mail::assertSent(NewSubmissionEmail::class, function ($mail) {
            return $mail->hasTo('notification@hubforms.io');
        });
    }

    public function testAFormIsDisplayed()
    {
        // given a form
        $form = factory(Form::class)->create();

        // with 5 fields
        $fields = factory(Field::class, 5)->create(['form_id' => $form->id]);

        // a request is sent to the endpoint
        $response = $this->get(route('form', $form));

        // i see the title
        $response->assertSee($form->title);

        // i see the description
        $response->assertSee($form->intro);

        // i see each of the fields
        foreach ($fields as $field) {
            $response->assertSee($field->title);
        }
    }

    public function testTheConfirmationMessageIsShownAfterSubmission()
    {
        // mock mails, this prevents us actually sending emails
        Mail::fake();

        // given a form
        $form = factory(Form::class)->create(['notification' => 'notification@hubforms.io']);

        // with a field
        $field = factory(Field::class)->create(['form_id' => $form->id]);

        // a submission can be made with valid details
        $response = $this->post(route('form.submit', $form), [
            $field->name => 'test value',
        ]);

        // the confirmation should be seen
        $response->assertSee($form->confirmation);
    }
}
