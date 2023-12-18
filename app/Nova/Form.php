<?php

namespace App\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use NovaItemsField\Items;

class Form extends Resource
{
    public static $model = \App\Models\Form::class;

    public static $title = 'label';

    public static $group = 'Forms';

    public static $search = [
        'id', 'name'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Label')
                ->maxlength(255)
                ->enforceMaxlength()
                ->rules('required', 'max:255'),

            Slug::make('System name')
                ->from('Label')
                ->creationRules('unique:forms')
                ->rules('required', 'max:255')
                ->help('this string is used to identify this form in code, changing this will require a code change')
                ->hideFromIndex(),

            Items::make('Notify emails')
                ->rules(['notify_emails.*' => 'email|min:5'])
                ->hideFromIndex(),

            Text::make('Notify Emails', function () {
                return implode(', ', $this->notify_emails);
            })->onlyOnIndex(),

            Number::make('Submissions', function () {
                return $this->formSubmissions->count();
            }),

            HasMany::make('Submissions', 'formSubmissions', FormSubmission::class),
        ];
    }
}
