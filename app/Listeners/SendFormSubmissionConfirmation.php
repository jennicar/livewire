<?php

namespace App\Listeners;

use App\Events\FormSubmitted;
use App\Mail\FormSubmissionConfirmation;
use Illuminate\Contracts\Mail\Mailer;

class SendFormSubmissionConfirmation
{
    private Mailer $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(FormSubmitted $event)
    {
        $submission = $event->formSubmission;

        if (!$submission->data['email']) {
            return;
        }

        $mailable = new FormSubmissionConfirmation($submission->data);

        $this->mailer->to($submission->data['email'])->send($mailable);
    }
}
