<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Category extends Resource
{
    public static $model = \App\Models\Category::class;

    public static $title = 'name';

    public static $group = 'Blog';

    public static $search = [
        'id',
        'name'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->maxlength(255)
                ->enforceMaxlength()
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make('Slug')
                ->rules('required', 'max:255', 'alpha_dash')
                ->hideFromIndex(),

            Textarea::make('Description')
                ->rules('required')
                ->hideFromIndex(),

            Image::make('Photo')
                ->disk(config('filesystems.cloud'))
                ->path('category'),
        ];
    }
}
