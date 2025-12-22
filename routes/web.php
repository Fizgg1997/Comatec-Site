<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CareerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Public routes are localized under /{locale} where locale is en|ar.
| Admin (Voyager) stays non-localized under /admin.
*/

// Redirect bare / to default locale (English)
Route::get('/', function () {
    return redirect('/en');
});

// ===== Localized public routes =====
Route::group([
    'prefix' => '{locale}',
    'where'  => ['locale' => 'en|ar'],
    'middleware' => ['setlocale'],
], function () {
    // --- TEMP PROBES (remove later) ---
Route::get('/_probe/pages', function ($locale) {
    $conn = \Illuminate\Support\Facades\DB::getDefaultConnection();
    $db   = \Illuminate\Support\Facades\DB::connection()->getDatabaseName();
    $rows = \Illuminate\Support\Facades\DB::table('pages')
                ->select('id','slug','title','status')
                ->orderBy('id')->get();
    return response()->json(compact('conn','db','rows'));
});

Route::get('/_probe/page/{slug}', function ($locale, $slug) {
    $slug = rawurldecode($slug);
    $norm = \Illuminate\Support\Str::slug($slug, '-');
    $conn = \Illuminate\Support\Facades\DB::getDefaultConnection();
    $db   = \Illuminate\Support\Facades\DB::connection()->getDatabaseName();

    $row = \Illuminate\Support\Facades\DB::table('pages')->where('slug',$slug)->first()
        ?: \Illuminate\Support\Facades\DB::table('pages')->whereRaw('LOWER(slug)=?', [mb_strtolower($slug)])->first()
        ?: \Illuminate\Support\Facades\DB::table('pages')->whereRaw('REPLACE(REPLACE(LOWER(slug)," ","-"),"_","-")=?', [$norm])->first();

    return response()->json(compact('conn','db','slug','norm','row'));
});

    // Home
    Route::get('/', [WebPageController::class, 'getContent'])->name('home');

    // Contact
    Route::get('/contact-us', [WebPageController::class, 'getContactUs'])->name('show.contact_us');
    Route::post('/store-contact-us', [ContactUsController::class, 'create'])->name('store.contact_us');

    // News & Articles
    Route::get('/news', [WebPageController::class, 'getNews'])->name('show.news');
    Route::get('/news-and-articles/{id}', [WebPageController::class, 'getNewsAndArticles'])->name('show.news_and_articles');
    
    // Projects
    Route::get('/project/{id}', [WebPageController::class, 'getProject'])->name('show.project');
    Route::get('/project-details/{id}', [WebPageController::class, 'getProjectDetails'])->name('show.project_details');

    // Industries / Business lines
    Route::get('/business-line/{id}', [WebPageController::class, 'getIndustry'])->name('show.industry');
    Route::get('/our-industries-details/{id}', [WebPageController::class, 'getOurIndustriesDetails'])->name('show.our_industries_details');

    // Pages (keep only one /page/{slug})
    Route::get('/page/{slug}', [WebPageController::class, 'getPage'])->name('show.page');

    // Awards & Certificates
    Route::get('/awards-certificates/{id}', [WebPageController::class, 'getAwardsOrCertificates'])
        ->name('show.award_and_certificate');

    // Careers
    Route::get('/career', [WebPageController::class, 'displayCareer'])->name('show.career');
    // Route::post('/apply-job', [CareerController::class, 'submit'])->name('apply-job');
});

// ===== Admin (Voyager) - not localized =====
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
