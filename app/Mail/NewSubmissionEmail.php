<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSubmissionEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $form;
    private $submission;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form, $submission)
    {
        //
        $this->form = $form;
        $this->submission = $submission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $form = $this->form;
        $submission = $this->submission;

        return $this->markdown('mail.submissions.new', compact(['form', 'submission']))
            ->subject('New submission on ' . $form->title);
    }
}
