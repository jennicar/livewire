<?php

namespace App\Providers;

use App\Events\FormSubmitted;
use App\Listeners\SendFormSubmissionConfirmation;
use App\Listeners\SendFormSubmissionNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        FormSubmitted::class => [
            SendFormSubmissionConfirmation::class,
            SendFormSubmissionNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
