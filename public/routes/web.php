<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CareerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect bare '/' to the current (or fallback) locale
Route::get('/', function () {
    $locale = session('locale', config('app.fallback_locale', 'en'));
    return redirect()->route('home', ['locale' => $locale]);
});

// Localized site routes
Route::group([
    'prefix' => '{locale}',
    'middleware' => 'setlocale',
    'where' => ['locale' => 'en|ar'], // adjust if you support more
], function () {

    // Home
    Route::get('/', [WebPageController::class, 'getContent'])->name('home');

    // Static pages
    Route::get('/contact-us', [WebPageController::class, 'getContactUs'])->name('show.contact_us');
    Route::get('/page/{slug}', [WebPageController::class, 'getPage'])->name('show.page');

    // Industries / Projects
    Route::get('/business-line/{id}', [WebPageController::class, 'getIndustry'])->name('show.industry');
    Route::get('/project/{id}', [WebPageController::class, 'getProject'])->name('show.project');
    Route::get('/project_details/{id}', [WebPageController::class, 'getProjectDetails'])->name('show.project_details');

    // Career
    Route::get('/career', [WebPageController::class, 'displayCareer'])->name('show.career');

    // News
    Route::get('/news', [WebPageController::class, 'getNews'])->name('show.news');
    Route::get('/news-and-articles/{id}', [WebPageController::class, 'getNewsAndArticles'])->name('show.news_and_articles');

    // Awards & Certificates (keep URI consistent with your links)
    Route::get('/awards-certificates/{id}', [WebPageController::class, 'getAwardsOrCertificates'])
        ->name('show.award_and_certificate');
});

// Voyager admin (NOT localized)
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
