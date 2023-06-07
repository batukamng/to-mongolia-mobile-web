<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 7/3/2019
 * Time: 11:45 PM
 */
namespace Modules\Language\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\FrontendController;
use Modules\Language\Models\Language;

class LanguageController extends FrontendController
{
    public function setLang(\Illuminate\Http\Request $request,$locale){

        $oldLocale = \App::getLocale();

        $path = $request->query('path');

        $this->setLocale($request, $locale);

        if(empty($path)){
            if ($request->query('redirectTo')) {
                $redirect = $request->query('redirectTo');
                return redirect($redirect);
            }
            return redirect('/');
        }

        if(strpos($path,$oldLocale) === 0){
            return redirect(str_replace($oldLocale,$locale,$path));
        }
        return redirect('/'.$path);
    }

    public function setAdminLang(\Illuminate\Http\Request $request,$locale){

        Cookie::queue('bc_admin_locale', $locale, 60*24*365);// one year

        return redirect()->back();

    }

    public function setLocale(\Illuminate\Http\Request $request,$locale){

        Cookie::queue('bc_web_locale', $locale, 60*24*365);// one year

        return redirect()->back();

    }


//     private function setLocale($locale, $request)
//     {
//         $lang = Language::where('locale',$locale)->first();

//         if(empty($lang)){
//             $locale = setting_item('site_locale');
//         }

//         $request->session()->put('website_locale', $locale);
// //
// //        return redirect(add_query_arg([
// //            'set_lang'=>
// //        ]))

//     }

}
