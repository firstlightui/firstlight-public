<?php

use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\LlmsTextController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/components', 'components.index')->name('components.index');
Route::get('/llms.txt', LlmsTextController::class)->name('llms');

Route::get('/docs/{path?}', DocumentationController::class)
    ->where('path', '.*')
    ->name('docs.show');
