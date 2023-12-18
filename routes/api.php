<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::group(['prefix' => 'form'], function () {
        Route::post('contact-request', [FormController::class, 'contactRequest'])
            ->middleware(ProtectAgainstSpam::class);
            // Must add <x-honeypot /> to form request in view.
            // https://github.com/spatie/laravel-honeypot
    });
});
