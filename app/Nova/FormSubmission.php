<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Text;

class FormSubmission extends Resource
{
    public static $model = \App\Models\FormSubmission::class;

    public static $group = 'Forms';

    public static $search = [
        'id', 'submitter_name', 'submitter_email'
    ];

    public static function label()
    {
        return 'Submissions';
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Form')->readonly(),

            Text::make('Submitter name')->sortable(),

            Text::make('Submitter email')->sortable(),

            KeyValue::make('Data'),

            DateTime::make('Created at'),
        ];
    }
}
