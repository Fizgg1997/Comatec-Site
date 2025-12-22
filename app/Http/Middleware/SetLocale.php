<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Prefer the route parameter; if for any reason it's null, use the URL's first segment
        $locale = $request->route('locale') ?? $request->segment(1);

        if (!in_array($locale, ['en','ar'])) {
            $locale = 'en';
        }

        App::setLocale($locale);

        // share lang/dir for <html> tag
        View::share('htmlDir', $locale === 'ar' ? 'rtl' : 'ltr');
        View::share('htmlLang', $locale);
        
        return $next($request);
    }
}
