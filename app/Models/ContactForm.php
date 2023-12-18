<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $casts = [
        'to_emails' => 'array',
    ];
}
