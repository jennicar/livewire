<?php

namespace App\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\{ ID, Image, Text };

class Author extends Resource
{
    public static $model = \App\Models\Author::class;

    public static $title = 'name';

    public static $group = 'Blog';

    public static $search = [
        'id',
        'name'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()
                ->sortable(),

            Text::make('Name')
                ->maxlength(255)
                ->enforceMaxlength()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Image::make('Photo')
                ->disk(config('filesystems.cloud'))
                ->path('author'),
        ];
    }
}
