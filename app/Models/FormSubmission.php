<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $casts = ['data' => 'json'];

    protected $fillable = ['submitter_email', 'submitter_name', 'data', 'form'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
