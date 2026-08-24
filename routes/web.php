<?php

use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\LlmsFullTextController;
use App\Http\Controllers\LlmsTextController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/components', 'components.index')->name('components.index');
Route::view('/firstlight-vs-nativephp-mobile-ui', 'comparison')->name('comparison');
Route::get('/llms.txt', LlmsTextController::class)->name('llms');
Route::get('/llms-full.txt', LlmsFullTextController::class)->name('llms.full');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/robots.txt', RobotsController::class)->name('robots');
Route::get('/pricing.md', PricingController::class)->name('pricing');

Route::get('/docs/{path?}', DocumentationController::class)
    ->where('path', '.*')
    ->name('docs.show');
