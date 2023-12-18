<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Front')->prefix('dev')->group(function () {
    Route::get('/svgs', 'DevController@svgs');
    Route::get('/design', 'DevController@design');
    Route::get('/shortcodes', 'DevController@shortcodes');
});
