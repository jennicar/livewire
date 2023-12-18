<?php

namespace App\Nova;

use Bythepixel\NovaTinymceField\NovaTinymceField;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Post extends Resource
{
    public static $model = \App\Models\Post::class;

    public static $title = 'title';

    public static $group = 'Blog';

    public static $with = ['category'];

    public static $search = ['id', 'title'];

    public static $indexDefaultOrder = ['published_at' => 'desc'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()
                ->sortable(),

            Text::make('Title')
                ->maxlength(255)
                ->enforceMaxlength()
                ->rules('required', 'max:255'),

            Text::make('Slug')
                ->size('w-1/2')
                ->rules('required', 'max:255', 'alpha_dash')
                ->hideFromIndex(),

            BelongsTo::make('Category')
                ->size('w-1/2')
                ->rules('required')
                ->nullable(false)
                ->sortable(),

            BelongsTo::make('Author')
                ->size('w-1/2')
                ->rules('required')
                ->nullable(false)
                ->sortable(),

            Text::make('Url', function () {
                $url = route('blog.show', $this);
                return "<a class='text-primary' href='$url' target='_blank'>$url<a/>";
            })->asHtml()->onlyOnDetail(),

            Textarea::make('Description')
                ->size('w-full')
                ->rows(3)
                ->help('Used to generate meta description if set')
                ->hideFromIndex(),

            Date::make('Published', 'published_at')
                ->size('w-1/3')
                ->sortable()
                ->help('Setting this will publish the article if a current or past date is selected')
                ->nullable(true),

            Date::make('Updated At')
                ->size('w-1/3')
                ->hideWhenCreating()
                ->hideFromIndex()
                ->readonly(),

            Date::make('Created At')
                ->size('w-1/3')
                ->hideWhenCreating()
                ->hideFromIndex()
                ->readonly(),

            Image::make('Photo')
                ->disk(config('filesystems.cloud'))
                ->path('post/featured'),

            Text::make('Photo Description')
                ->rules('max:255')
                ->help('Describes the appearance and function of an image on a page.')
                ->hideFromIndex(),

            NovaTinymceField::make('Content')
                ->size('w-full')
                ->withFiles(config('filesystems.cloud'), 'post/content')
                ->rules('required')
                ->hideFromIndex(),

            Text::make('Url', function () {
                $url = route('blog.show', $this);
                return "<a class='font-bold no-underline dim text-primary' href='$url' target='_blank'>Link</a>";
            })->asHtml()->onlyOnIndex(),
        ];
    }
}
