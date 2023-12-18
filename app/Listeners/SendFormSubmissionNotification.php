<?php

namespace App\Listeners;

use App\Events\FormSubmitted;
use App\Mail\FormSubmissionNotification;
use Illuminate\Contracts\Mail\Mailer;

class SendFormSubmissionNotification
{
    private Mailer $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(FormSubmitted $event)
    {
        $form = $event->formSubmission->form;

        if (!$form->notify_emails) {
            return;
        }

        $mailable = new FormSubmissionNotification($event->formSubmission->data);

        $this->mailer
            ->to($event->formSubmission->form->notify_emails)
            ->send($mailable);
    }
}
