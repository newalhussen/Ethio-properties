<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Lang
{
    private const ALLOWED_LOCALES = ['en', 'am', 'or'];

    public function handle(Request $request, Closure $next)
    {
        // If ?lang=xx is in URL, store it in session
        if ($request->has('lang') && in_array($request->get('lang'), self::ALLOWED_LOCALES, true)) {
            session()->put("lang_code", $request->get('lang'));
        }

        // Use session lang_code if available
        if (session()->has("lang_code")) {
            App::setLocale(session()->get("lang_code"));
        }

        return $next($request);
    }
}
