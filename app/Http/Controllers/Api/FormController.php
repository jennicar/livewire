<?php

namespace App\Http\Controllers\Api;

use App\Events\FormSubmitted;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends ApiController
{
    public function contactRequest(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'message' => 'nullable',
        ]);

        $form = Form::contactRequestForm()->firstOrFail();

        $submission = $form->formSubmissions()->create([
            'submitter_email'  => $validatedData['email'],
            'submitter_name'  => $validatedData['name'],
            'data' => $validatedData,
        ]);

        FormSubmitted::dispatch($submission);

        return response()->json(['success' => true]);
    }
}
