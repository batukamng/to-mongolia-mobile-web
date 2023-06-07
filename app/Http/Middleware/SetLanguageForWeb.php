<?php
namespace App\Http\Middleware;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use Closure;
class SetLanguageForWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (strpos($request->path(), 'install') === false && file_exists(storage_path() . '/installed')) {

            $request = \request();
            $locale = $request->segment(1);
            $languages = \Modules\Language\Models\Language::getActive();
            $localeCodes = Arr::pluck($languages,'locale');
            // For Web
            if($request->cookie('bc_web_locale')){
                $locale = $request->cookie('bc_web_locale');
                
            }
            if(in_array($locale,$localeCodes)){
                app()->setLocale($locale);
                // dd(app()->getLocale());
            }else{
                app()->setLocale(setting_item('site_locale'));
            }

        }
        return $next($request);
    }
}
