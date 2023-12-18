<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $casts = [
        'notify_emails' => 'array',
    ];

    public function formSubmissions()
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function scopeContactRequestForm(Builder $query)
    {
        return $query->where('system_name', 'contact-request')->limit(1);
    }
}
