<?php

namespace App\Nova;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Redirect extends Resource
{
    public static $model = \App\Models\Redirect::class;

    public static $title = 'id';

    public static $group = 'System';

    public static $search = [
        'id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Origin')
                ->sortable()
                ->stacked()
                ->rules('required', 'max:255'),

            Text::make('Destination')
                ->sortable()
                ->stacked()
                ->rules('required', 'max:255'),

            Select::make('Status code')
                ->sortable()
                ->rules('required', 'max:255')
                ->options([
                    301 => '301 - Permanent Redirect',
                    302 => '302 - Temporary Redirect'
                ])
                ->default(302),

            Text::make('Hits')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            DateTime::make('Created At')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->hideFromIndex(),

            DateTime::make('Last Hit At')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating()
        ];
    }
}
