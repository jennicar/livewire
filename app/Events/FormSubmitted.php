<?php

namespace App\Events;

use App\Models\FormSubmission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FormSubmitted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public FormSubmission $formSubmission;

    public function __construct(FormSubmission $formSubmission)
    {
        $this->formSubmission = $formSubmission;
    }
}
