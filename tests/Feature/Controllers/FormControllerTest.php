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

    public function test_an_email_is_sent_to_notification_address_on_submission()
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
        Mail::assertSent(NewSubmissionEmail::class, function ($mail) use ($form) {
            return $mail->hasTo('notification@hubforms.io');
        });
    }
}
