<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

use App\Header;
use App\OurIndustry;
use App\OurClient;
use App\AwardsAndCertificate;
use App\NewsAndArticle;
use App\Page;
use App\OurTeam;
use App\Project;
use App\ProjectsDetails;
use App\PromoteImage;
use App\OurIndustriesDetail;
use App\Statistic;

class WebPageController extends Controller
{
    /* =========================
       Helpers
       ========================= */

    /**
     * Translation with safe manual fallbacks.
     * Order:
     * 1) getTranslatedAttribute (Voyager/dimsav)
     * 2) <field>_<locale> column (if present)
     * 3) <field>_<fallback> column (if present)
     * 4) Base field
     */
    private function tr($model, string $field, string $locale, string $fallback)
    {
        if (is_object($model) && method_exists($model, 'getTranslatedAttribute')) {
            $val = $model->getTranslatedAttribute($field, $locale, $fallback);
            if ($val !== null && $val !== '') return $val;
        }

        $locField = $field . '_' . $locale;
        if (is_object($model) && isset($model->{$locField}) && $model->{$locField} !== '') {
            return $model->{$locField};
        }

        $fbField = $field . '_' . $fallback;
        if (is_object($model) && isset($model->{$fbField}) && $model->{$fbField} !== '') {
            return $model->{$fbField};
        }

        return is_object($model) ? ($model->{$field} ?? '') : '';
    }

    /** Normalize a stored path (Voyager often saves with backslashes on Windows). */
    private function norm(?string $path): ?string
    {
        return $path ? str_replace('\\', '/', $path) : null;
    }

    private function mapIndustry(OurIndustry $m, string $locale, string $fallback): array
    {
        return [
            'id'      => $m->id,
            'title'   => $this->tr($m, 'title', $locale, $fallback),
            'summary' => $this->tr($m, 'summary', $locale, $fallback),
            'image'   => $this->norm($m->image),
            'icon'    => $this->norm($m->icon),
            'color'   => $m->color,
        ];
    }

    private function mapPage(Page $m, string $locale, string $fallback): array
    {
        $slugValue =
            ($m->slug ?? null) ??
            ($m->{'slug_'.$locale} ?? null) ??
            ($m->slug_en ?? null) ??
            ($m->slug_ar ?? null);

        return [
            'id'    => $m->id,
            'image' => $this->norm($m->image),
            'icon'  => $this->norm($m->icon),
            'slug'  => $slugValue,
            'title' => $this->tr($m, 'title', $locale, $fallback),
            'body'  => $this->tr($m, 'body', $locale, $fallback),
        ];
    }

    private function mapTeam(OurTeam $m, string $locale, string $fallback): array
    {
        return [
            'id'        => $m->id,
            'name'      => $this->tr($m, 'name', $locale, $fallback),
            'job_title' => $this->tr($m, 'job_title', $locale, $fallback),
            'image'     => $this->norm($m->image),
            'linkedIn_account' => $m->linkedIn_account,
        ];
    }

    private function mapProject(Project $m, string $locale, string $fallback): array
    {
        return [
            'id'      => $m->id,
            'title'   => $this->tr($m, 'title', $locale, $fallback),
            'summary' => $this->tr($m, 'summary', $locale, $fallback),
            'image'   => $this->norm($m->image),
        ];
    }

    private function mapNews(NewsAndArticle $m, string $locale, string $fallback): array
    {
        return [
            'id'      => $m->id,
            'title'   => $this->tr($m, 'title', $locale, $fallback),
            'summary' => $this->tr($m, 'summary', $locale, $fallback),
            'image'   => $this->norm($m->image),
            'date'    => $m->date,
        ];
    }

    private function mapStat(Statistic $m, string $locale, string $fallback): array
    {
        return [
            'id'                 => $m->id,
            'icon'               => $this->norm($m->icon),
            'achievement_number' => $m->achievement_number,
            'title'              => $this->tr($m, 'title', $locale, $fallback),
        ];
    }

    private function getIndustriesData(): array
    {
        $locale   = app()->getLocale();
        $fallback = config('app.fallback_locale', 'en');

        return OurIndustry::orderBy('id')->take(4)->get()
            ->map(fn ($m) => $this->mapIndustry($m, $locale, $fallback))
            ->toArray();
    }

    /**
     * Always return 3 pages for the home tiles (About/Mission/Vision),
     * with defensive ordering and multiple fallbacks.
     */
    private function getHomePages(string $locale, string $fallback): array
    {
        $q = Page::withoutGlobalScopes();

        if (Schema::hasColumn('pages', 'show_on_home')) {
            $q->where('show_on_home', 1);
        }

        if (Schema::hasColumn('pages', 'sort_order')) {
            $q->orderBy('sort_order');
        }
        $q->orderBy('id');

        $pages = $q->limit(3)->get();

        if ($pages->isEmpty()) {
            $slugs  = ['about-us','our-mission','our-vision','about','mission','vision','aboutus','ourvision'];
            $bySlug = Page::withoutGlobalScopes()->whereIn('slug', $slugs)->get()->keyBy('slug');
            $pages  = collect($slugs)->map(fn($s) => $bySlug[$s] ?? null)->filter();
        }

        if ($pages->isEmpty()) {
            $pages = Page::withoutGlobalScopes()->orderBy('id')->limit(3)->get();
        }

        return $pages->map(fn ($m) => $this->mapPage($m, $locale, $fallback))
                     ->values()->toArray();
    }

    /* =========================
       Actions (force locale from route)
       ========================= */

    public function getContent(string $locale)
    {
        App::setLocale($locale);
        $fallback = config('app.fallback_locale', 'en');

        /** Header (safe if none exists) */
        $header = null;
        if ($h = Header::first()) {
            $raw  = $h->background_image;
            $path = str_replace('\\', '/', $raw);
            $bgUrl = Storage::disk('public')->url($path);

            $header = [
                'id'          => $h->id,
                'bg_url'      => $bgUrl,
                'title'       => $this->tr($h, 'title', $locale, $fallback),
                'description' => $this->tr($h, 'description', $locale, $fallback),
            ];
        }

        /** Industries */
        $industries = OurIndustry::orderBy('id')->take(4)->get()
            ->map(fn ($m) => $this->mapIndustry($m, $locale, $fallback))
            ->toArray();

        $our_industry = OurIndustry::orderBy('id')->get()
            ->slice(4)->values()
            ->map(fn ($m) => [
                'id'      => $m->id,
                'title'   => $this->tr($m, 'title', $locale, $fallback),
                'summary' => $this->tr($m, 'summary', $locale, $fallback),
                'image'   => $this->norm($m->image),
            ])->toArray();

        /** Clients, Partners, Certificates, Awards */
        $our_clients  = OurClient::where('type', 'client')->limit(12)->get()->toArray();
        $our_partners = OurClient::where('type', 'partner')->limit(12)->get()->toArray();
        $certificates = AwardsAndCertificate::where('type', 'certificate')->limit(12)->get()->toArray();

        $awards = AwardsAndCertificate::where('type', 'award')->limit(12)->get()
            ->map(fn ($m) => [
                'id'    => $m->id,
                'image' => $this->norm($m->image),
                'title' => $this->tr($m, 'title', $locale, $fallback),
            ])->toArray();

        /** News */
        $news_and_articles = NewsAndArticle::orderBy('date', 'DESC')->get()
            ->map(fn ($m) => $this->mapNews($m, $locale, $fallback))
            ->toArray();

        /** PAGES row (About/Mission/Vision) */
        $pages = $this->getHomePages($locale, $fallback);

        /** Team, Projects */
        $our_team = OurTeam::limit(9)->get()
            ->map(fn ($m) => $this->mapTeam($m, $locale, $fallback))
            ->toArray();

        $projects = Project::limit(4)->get()
            ->map(fn ($m) => $this->mapProject($m, $locale, $fallback))
            ->toArray();

        /** Statistics (KPI row) */
        $statsQ = Statistic::query();
        if (Schema::hasColumn('statistics', 'sort_order')) {
            $statsQ->orderBy('sort_order');
        }
        $statsQ->orderBy('id')->limit(5);

        $statistics = $statsQ->get()
            ->map(fn ($m) => $this->mapStat($m, $locale, $fallback))
            ->toArray();

        return view('welcome', compact(
            'header',
            'industries',
            'our_industry',
            'our_clients',
            'our_partners',
            'certificates',
            'awards',
            'news_and_articles',
            'pages',
            'our_team',
            'projects',
            'statistics'
        ));
    }

    public function getNewsAndArticles(string $locale, $id)
    {
        App::setLocale($locale);
        $fallback = config('app.fallback_locale', 'en');

        $validator = Validator::make(['id' => $id], ['id' => 'exists:news_and_articles,id']);
        if ($validator->fails()) return response()->json(['error' => 'invalid id'], 400);

        $data = NewsAndArticle::findOrFail($id);
        $data->title   = $this->tr($data, 'title', $locale, $fallback);
        $data->summary = $this->tr($data, 'summary', $locale, $fallback);
        $data->body    = $this->tr($data, 'body', $locale, $fallback);

        $industries = $this->getIndustriesData();

        $news_and_articles = NewsAndArticle::orderBy('date', 'DESC')->get()
            ->map(fn ($m) => $this->mapNews($m, $locale, $fallback))
            ->toArray();

        return view('custom-page', compact('data', 'industries', 'news_and_articles'));
    }

    public function getProject(string $locale, $id)
    {
        App::setLocale($locale);
        $fallback = config('app.fallback_locale', 'en');

        $validator = Validator::make(['id' => $id], ['id' => 'exists:projects,id']);
        if ($validator->fails()) return response()->json(['error' => 'invalid id'], 400);

        $data = Project::findOrFail($id);
        $data->title   = $this->tr($data, 'title', $locale, $fallback);
        $data->summary = $this->tr($data, 'summary', $locale, $fallback);
        $data->body    = $this->tr($data, 'body', $locale, $fallback);

        $industries = $this->getIndustriesData();

        $projects = Project::where('id', '!=', $id)->get()
            ->map(fn ($m) => $this->mapProject($m, $locale, $fallback))
            ->toArray();

        $projects_details = ProjectsDetails::where('project_id', $id)->get()->toArray();

        return view('project', compact('data', 'industries', 'projects', 'projects_details'));
    }

    public function getIndustry(string $locale, $id)
    {
        App::setLocale($locale);
        $fallback = config('app.fallback_locale', 'en');

        $validator = Validator::make(['id' => $id], ['id' => 'exists:our_industries,id']);
        if ($validator->fails()) return response()->json(['error' => 'invalid id'], 400);

        $project_details = OurIndustriesDetail::where('business_id', $id)->get();

        $data = OurIndustry::findOrFail($id);
        $data->title       = $this->tr($data, 'title', $locale, $fallback);
        $data->summary     = $this->tr($data, 'summary', $locale, $fallback);
        $data->description = $this->tr($data, 'description', $locale, $fallback);

        $industries = $this->getIndustriesData();

        $promote_images = PromoteImage::select('images', 'link')->get()->toArray();

        return view('industry', compact('data', 'industries', 'promote_images', 'project_details'));
    }

    /**
     * Page endpoint — use Eloquent so Voyager translations are applied.
     * Performs exact → case-insensitive → normalized slug match.
     */
    public function getPage(string $locale, $slug)
    {
        App::setLocale($locale);
        $fallback = config('app.fallback_locale', 'en');

        $slug = rawurldecode($slug);
        $norm = Str::slug($slug, '-');
        $base = Page::withoutGlobalScopes();

        $data = (clone $base)->where('slug', $slug)->first()
            ?: (clone $base)->whereRaw('LOWER(slug) = ?', [mb_strtolower($slug)])->first()
            ?: (clone $base)->whereRaw('REPLACE(REPLACE(LOWER(slug), " ", "-"), "_", "-") = ?', [$norm])->first();

        if (! $data) {
            abort(404);
        }

        // Apply translations for the requested locale
        $data->title   = $this->tr($data, 'title', $locale, $fallback);
        $data->body    = $this->tr($data, 'body', $locale, $fallback);
        $data->excerpt = $this->tr($data, 'excerpt', $locale, $fallback);

        $industries = $this->getIndustriesData();

        $pages = Page::withoutGlobalScopes()
            ->when(Schema::hasColumn('pages', 'sort_order'), fn ($q) => $q->orderBy('sort_order'))
            ->orderBy('id')
            ->get()
            ->map(fn ($m) => $this->mapPage($m, $locale, $fallback))
            ->toArray();

        return view('page', compact('data', 'industries', 'pages'));
    }

    public function getAwardsOrCertificates(string $locale, $id)
    {
        App::setLocale($locale);
        $fallback = config('app.fallback_locale', 'en');

        $validator = Validator::make(['id' => $id], ['id' => 'exists:awards_and_certificates,id']);
        if ($validator->fails()) return response()->json(['error' => 'invalid id'], 400);

        $data = AwardsAndCertificate::findOrFail($id);
        $data->title       = $this->tr($data, 'title', $locale, $fallback);
        $data->description = $this->tr($data, 'description', $locale, $fallback);

        $industries = $this->getIndustriesData();

        $awards_and_certificates = AwardsAndCertificate::where('type', $data->type)->get()
            ->map(fn ($m) => [
                'id'    => $m->id,
                'image' => $this->norm($m->image),
                'title' => $this->tr($m, 'title', $locale, $fallback),
            ])->toArray();

        return view('award_and_certificate', compact('data', 'industries', 'awards_and_certificates'));
    }

    public function getContactUs(string $locale)
    {
        App::setLocale($locale);
        $industries = $this->getIndustriesData();
        return view('contact-us', compact('industries'));
    }

    public function displayCareer(string $locale)
    {
        App::setLocale($locale);
        $industries = $this->getIndustriesData();
        return view('career', compact('industries'));
    }

    public function getProjectDetails(string $locale, $id)
    {
        App::setLocale($locale);
        $validator = Validator::make(['id' => $id], ['id' => 'exists:projects_details,id']);
        if ($validator->fails()) return response()->json(['error' => 'invalid id'], 400);

        $data = ProjectsDetails::findOrFail($id);
        $industries = $this->getIndustriesData();

        return view('project_details', compact('data', 'industries'));
    }

    /* Optional: JSON utility endpoint (not under locale group) */
    public function getData($type, $id)
    {
        $model = app()->make('App\\' . $type);
        $data = $model::find($id);
        return response()->json(['data' => $data]);
    }
}
