<?php
use Modules\Core\Models\Settings;
use App\Currency;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

//include '../../custom/Helpers/CustomHelper.php';

define( 'MINUTE_IN_SECONDS', 60 );
define( 'HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS );
define( 'DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS );
define( 'WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS );
define( 'MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS );
define( 'YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS );

function setting_item($item,$default = '',$isArray = false){

    $res = Settings::item($item,$default);

    if($isArray and !is_array($res)){
        $res = (array) json_decode($res,true);
    }

    return $res;

}
function setting_item_array($item,$default = ''){

    return setting_item($item,$default,true);

}

function setting_item_with_lang($item,$locale = '',$default = '',$withOrigin = true){

    if(empty($locale)) $locale = app()->getLocale();

    if($withOrigin == false and $locale == setting_item('site_locale')){
        return $default;
    }

    if( empty(setting_item('site_locale'))
        OR empty(setting_item('site_enable_multi_lang'))
        OR  $locale == setting_item('site_locale')
    ){
        $locale = '';
    }

    return Settings::item($item.($locale ? '_'.$locale : ''),$withOrigin ? setting_item($item,$default) : $default);

}
function setting_item_with_lang_raw($item,$locale = '',$default = ''){

    return setting_item_with_lang($item,$locale,$default,false);
}
function setting_update_item($item,$val){

    $s = Settings::where('name',$item)->first();
    if(empty($s)){
        $s = new Settings();
        $s->name = $item;
    }

    if(is_array($val) or is_object($val)) $val = json_encode($val);
    $s->val = $val;

    $s->save();

    Cache::forget('setting_' . $item);

    return $s;
}

function app_get_locale($locale = false , $before = false , $after = false){
    // if(setting_item('site_enable_multi_lang') and app()->getLocale() != setting_item('site_locale')){
    //     return $locale ? $before.$locale.$after : $before.app()->getLocale().$after;
    // }
    return '';
}

function format_money($price){

   return Currency::format((float)$price);

}
function format_money_main($price){

   return Currency::format((float)$price,true);

}

function currency_symbol(){

    $currency_main = get_current_currency('currency_main');

    $currency = Currency::getCurrency($currency_main);

    return $currency['symbol'] ?? '';
}

function generate_menu($location = '',$options = [])
{
    $options['walker'] = $options['walker'] ?? '\\Modules\\Core\\Walkers\\MenuWalker';

    $setting = json_decode(setting_item('menu_locations'),true);

    if(!empty($setting))
    {
        foreach($setting as $l=>$menuId){
            if($l == $location and $menuId){
                $menu = (new \Modules\Core\Models\Menu())->findById($menuId);
                $translation = $menu->translateOrOrigin(app()->getLocale());

                $walker = new $options['walker']($translation);

                if(!empty($translation)){
                    $walker->generate();
                }
            }
        }
    }
}

function set_active_menu($item){
    \Modules\Core\Walkers\MenuWalker::setCurrentMenuItem($item);
}

 function get_exceprt($string,$length=200,$more = "[...]"){
        $string=strip_tags($string);
        if(str_word_count($string)>0) {
            $arr=explode(' ',$string);
            $excerpt='';
            if(count($arr)>0) {
                $count=0;
                if($arr) foreach($arr as $str) {
                    $count+=strlen($str);
                    if($count>$length) {
                        $excerpt.= $more;
                        break;
                    }
                    $excerpt.=' '.$str;
                }
                }return $excerpt;
            }
}

function getDatefomat($value) {
    return \Carbon\Carbon::parse($value)->format('j F, Y');

}

function get_file_url($file_id,$size="thumb",$resize = true){
    if(empty($file_id)) return null;
    return \Modules\Media\Helpers\FileHelper::url($file_id,$size,$resize);
}

function get_image_tag($image_id,$size = 'thumb',$options = []){
    $options = array_merge($options,[
       'lazy'=>true
    ]);

    $url = get_file_url($image_id,$size);

    if($url){
        $alt = $options['alt'] ?? '';
        $attr = '';
        $class= $options['class'] ?? '';
        if(!empty($options['lazy'])){
            $class.=' lazy';
            $attr.=" data-src=".e($url)." ";
        }else{
            $attr.=" src='".e($url)."' ";
        }
        return sprintf("<img class='%s' %s alt='%s'>",e($class),e($attr),e($alt));
    }
}
function get_date_format(){
    return setting_item('date_format','m/d/Y');
}
function get_moment_date_format(){
    return php_to_moment_format(get_date_format());
}
function php_to_moment_format($format){

    $replacements = [
        'd' => 'DD',
        'D' => 'ddd',
        'j' => 'D',
        'l' => 'dddd',
        'N' => 'E',
        'S' => 'o',
        'w' => 'e',
        'z' => 'DDD',
        'W' => 'W',
        'F' => 'MMMM',
        'm' => 'MM',
        'M' => 'MMM',
        'n' => 'M',
        't' => '', // no equivalent
        'L' => '', // no equivalent
        'o' => 'YYYY',
        'Y' => 'YYYY',
        'y' => 'YY',
        'a' => 'a',
        'A' => 'A',
        'B' => '', // no equivalent
        'g' => 'h',
        'G' => 'H',
        'h' => 'hh',
        'H' => 'HH',
        'i' => 'mm',
        's' => 'ss',
        'u' => 'SSS',
        'e' => 'zz', // deprecated since version 1.6.0 of moment.js
        'I' => '', // no equivalent
        'O' => '', // no equivalent
        'P' => '', // no equivalent
        'T' => '', // no equivalent
        'Z' => '', // no equivalent
        'c' => '', // no equivalent
        'r' => '', // no equivalent
        'U' => 'X',
    ];
    $momentFormat = strtr($format, $replacements);
    return $momentFormat;
}

function display_date($time){

    if($time){
        if(is_string($time)){
            $time = strtotime($time);
        }

        if(is_object($time)){
            return $time->format(get_date_format());
        }
    }else{
       $time=strtotime(today());
    }

    return date(get_date_format(),$time);
}

function display_datetime($time){

    if(is_string($time)){
        $time = strtotime($time);
    }

    if(is_object($time)){
        return $time->format(get_date_format().' H:i');
    }

    return date(get_date_format().' H:i',$time);
}

function human_time_diff($from,$to = false){

    if(is_string($from)) $from = strtotime($from);
    if(is_string($to)) $to = strtotime($to);

    if ( empty( $to ) ) {
        $to = time();
    }

    $diff = (int) abs( $to - $from );

    if ( $diff < HOUR_IN_SECONDS ) {
        $mins = round( $diff / MINUTE_IN_SECONDS );
        if ( $mins <= 1 ) {
            $mins = 1;
        }
        /* translators: Time difference between two dates, in minutes (min=minute). %s: Number of minutes */
        if($mins){
            $since =__(':num mins',['num'=>$mins]);
        }else{
            $since =__(':num min',['num'=>$mins]);
        }

    } elseif ( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ) {
        $hours = round( $diff / HOUR_IN_SECONDS );
        if ( $hours <= 1 ) {
            $hours = 1;
        }
        /* translators: Time difference between two dates, in hours. %s: Number of hours */
        if($hours){
            $since =__(':num hours',['num'=>$hours]);
        }else{
            $since =__(':num hour',['num'=>$hours]);
        }

    } elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
        $days = round( $diff / DAY_IN_SECONDS );
        if ( $days <= 1 ) {
            $days = 1;
        }
        /* translators: Time difference between two dates, in days. %s: Number of days */
        if($days){
            $since =__(':num days',['num'=>$days]);
        }else{
            $since =__(':num day',['num'=>$days]);
        }

    } elseif ( $diff < MONTH_IN_SECONDS && $diff >= WEEK_IN_SECONDS ) {
        $weeks = round( $diff / WEEK_IN_SECONDS );
        if ( $weeks <= 1 ) {
            $weeks = 1;
        }
        /* translators: Time difference between two dates, in weeks. %s: Number of weeks */
        if($weeks){
            $since =__(':num weeks',['num'=>$weeks]);
        }else{
            $since =__(':num week',['num'=>$weeks]);
        }

    } elseif ( $diff < YEAR_IN_SECONDS && $diff >= MONTH_IN_SECONDS ) {
        $months = round( $diff / MONTH_IN_SECONDS );
        if ( $months <= 1 ) {
            $months = 1;
        }
        /* translators: Time difference between two dates, in months. %s: Number of months */

        if($months){
            $since =__(':num months',['num'=>$months]);
        }else{
            $since =__(':num month',['num'=>$months]);
        }

    } elseif ( $diff >= YEAR_IN_SECONDS ) {
        $years = round( $diff / YEAR_IN_SECONDS );
        if ( $years <= 1 ) {
            $years = 1;
        }
        /* translators: Time difference between two dates, in years. %s: Number of years */
        if($years){
            $since =__(':num years',['num'=>$years]);
        }else{
            $since =__(':num year',['num'=>$years]);
        }
    }

    return $since;
}

function human_time_diff_short($from,$to = false){
    if(!$to) $to = time();
    $today = strtotime(date('Y-m-d 00:00:00',$to));

    $diff = $from - $to;

    if($from > $today){
        return date('h:i A',$from);
    }

    if($diff < 5* DAY_IN_SECONDS){
        return date('D',$from);
    }

    return date('M d',$from);
}

function _n($l,$m,$count){
    if($count){
        return $m;
    }
    return $l;
}
function get_country_lists(){
    $countries = array
    (
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua And Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia And Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, Democratic Republic',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island & Mcdonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic Of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle Of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States Of',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts And Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre And Miquelon',
        'VC' => 'Saint Vincent And Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome And Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia And Sandwich Isl.',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard And Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad And Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks And Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis And Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
    );
    return $countries;
}

function get_country_name($name){
    $all = get_country_lists();

    return $all[$name] ?? $name;
}

function get_page_url($page_id)
{
    $page = \Modules\Page\Models\Page::find($page_id);

    if($page){
        return $page->getDetailUrl();
    }
    return false;
}

function get_payment_gateway_obj($payment_gateway){

    $gateways = get_payment_gateways();

    if(empty($gateways[$payment_gateway]) or !class_exists($gateways[$payment_gateway]))
    {
        return false;
    }

    $gatewayObj = new $gateways[$payment_gateway]($payment_gateway);

    return $gatewayObj;

}

function recaptcha_field($action){
    return \App\Helpers\ReCaptchaEngine::captcha($action);
}

function add_query_arg($args,$uri = false) {

    if(empty($uri)) $uri = request()->url();

    $query = request()->query();

    if(!empty($args)){
        foreach ($args as $k=>$arg){
            $query[$k] = $arg;
        }
    }

    return $uri.'?'.http_build_query($query);
}

function is_default_lang($lang = '')
{
    if(!$lang) $lang = request()->query('lang');
    if(!$lang) $lang = request()->route('lang');

    if(empty($lang) or $lang == setting_item('site_locale')) return true;

    return false;
}

function get_lang_switcher_url($locale = false){

    $request =  request();
    $data = $request->query();
    $data['set_lang'] = $locale;

    $url1 = url()->current();

    // $url.='?'.http_build_query($data);
    // $url="/language/set-lang/?redirectTo=".url()->current();
    $url="/language/set-lang/".$locale."?redirectTo=".url()->current();

    return url($url);
}
function get_currency_switcher_url($code = false){

    $request =  request();
    $data = $request->query();
    $data['set_currency'] = $code;

    $url = url()->current();

    $url.='?'.http_build_query($data);

    return url($url);
}


function translate_or_origin($key,$settings = [],$locale = '')
{
    if(empty($locale)) $locale = request()->query('lang');

    if($locale and $locale == setting_item('site_locale')) $locale = false;

    if(empty($locale)) return $settings[$key] ?? '';
    else{
        return $settings[$key.'_'.$locale] ?? '';
    }
}

function get_bookable_services(){

    $all = [];

    // Modules
    $custom_modules = \Modules\ServiceProvider::getActivatedModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $moduleData){
            $moduleClass = $moduleData['class'];
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getBookableServices']);
                $all = array_merge($all,$services);
            }

        }
    }


    // Plugin Menu
    $plugins_modules = \Plugins\ServiceProvider::getModules();
    if(!empty($plugins_modules)){
        foreach($plugins_modules as $module){
            $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getBookableServices']);
                $all = array_merge($all,$services);
            }
        }
    }

    // Custom Menu
    $custom_modules = \Custom\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getBookableServices']);
                $all = array_merge($all,$services);
            }
        }
    }
    return $all;
}
function get_payable_services(){
    $all = get_bookable_services();

    // Modules
    $custom_modules = \Modules\ServiceProvider::getActivatedModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $moduleData){
            $moduleClass = $moduleData['class'];
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getPayableServices']);
                $all = array_merge($all,$services);
            }

        }
    }

    return $all;
}
function get_bookable_service_by_id($id){

    $all = get_bookable_services();

    return $all[$id] ?? null;
}

function file_get_contents_curl($url,$isPost = false,$data = []) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    if($isPost){
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function size_unit_format($number=''){
    switch (setting_item('size_unit')){
        case "m2":
            return $number." m<sup>2</sup>";
            break;
        default:
            return $number." ".__('sqft');
            break;
    }
}

function get_payment_gateways(){
    //getBlocks
    $gateways = config('booking.payment_gateways');
    // Modules
    $custom_modules = \Modules\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $gateway = call_user_func([$moduleClass,'getPaymentGateway']);
                if(!empty($gateway)){
                    $gateways = array_merge($gateways,$gateway);
                }
            }
        }
    }
    //Plugin
    $plugin_modules = \Plugins\ServiceProvider::getModules();
    if(!empty($plugin_modules)){
        foreach($plugin_modules as $module){
            $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $gateway = call_user_func([$moduleClass,'getPaymentGateway']);
                if(!empty($gateway)){
                    $gateways = array_merge($gateways,$gateway);
                }
            }
        }
    }

    //Custom
    $custom_modules = \Custom\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $gateway = call_user_func([$moduleClass,'getPaymentGateway']);
                if(!empty($gateway)){
                    $gateways = array_merge($gateways,$gateway);
                }
            }
        }
    }
    return $gateways;
}

function get_current_currency($need,$default = '')
{
    return Currency::getCurrent($need,$default);
}

function booking_status_to_text($status)
{
    switch ($status){
        case "draft":
            return __('Draft');
            break;
        case "unpaid":
            return __('Unpaid');
            break;
        case "paid":
            return __('Paid');
            break;
        case "processing":
            return __('Processing');
            break;
        case "completed":
            return __('Completed');
            break;
        case "confirmed":
            return __('Confirmed');
            break;
        case "cancelled":
            return __('Cancelled');
            break;
        case "cancel":
            return __('Cancel');
            break;
        case "pending":
            return __('Pending');
            break;
        case "partial_payment":
            return __('Partial Payment');
            break;
        case "fail":
            return __('Failed');
            break;
        default:
            return ucfirst($status ?? '');
            break;
    }
}
function verify_type_to($type,$need = 'name')
{
    switch ($type){
        case "phone":
            return __("Phone");
            break;
        case "number":
            return __("Number");
            break;
        case "email":
            return __("Email");
            break;
        case "file":
            return __("Attachment");
            break;
        case "multi_files":
            return __("Multi Attachments");
            break;
        case "text":
        default:
            return __("Text");
            break;
    }
}

function get_all_verify_fields(){
    return setting_item_array('role_verify_fields');
}
/*Hook Functions*/
function add_action($hook, $callback, $priority = 20, $arguments = 1){
    return \Modules\Core\Facades\Hook::addAction($hook, $callback, $priority, $arguments);
}
function add_filter($hook, $callback, $priority = 20, $arguments = 1){
    return \Modules\Core\Facades\Hook::addFilter($hook, $callback, $priority, $arguments);
}
function do_action(){
    return \Modules\Core\Facades\Hook::action(...func_get_args());
}
function apply_filters(){
    return \Modules\Core\Facades\Hook::filter(...func_get_args());
}
function is_installed(){
    return file_exists(storage_path('installed'));
}
function is_enable_multi_lang(){
    return (bool) setting_item('site_enable_multi_lang');
}

function is_enable_language_route(){
    return (is_installed() and is_enable_multi_lang() and app()->getLocale() != setting_item('site_locale'));
}

function duration_format($hour,$is_full = false)
{
    $day = floor($hour / 24) ;
    $hour = $hour % 24;
    $tmp = '';

    if($day) $tmp = $day.__('D');

    if($hour)
    $tmp .= $hour.__('H');

    if($is_full){
        $tmp = [];
        if($day){
            if($day > 1){
                $tmp[] = __(':count Days',['count'=>$day]);
            }else{
                $tmp[] = __(':count Day',['count'=>$day]);
            }
        }
        if($hour){
            if($hour > 1){
                $tmp[] = __(':count Hours',['count'=>$hour]);
            }else{
                $tmp[] = __(':count Hour',['count'=>$hour]);
            }
        }

        $tmp = implode(' ',$tmp);
    }

    return $tmp;
}
function is_enable_guest_checkout(){
    return setting_item('booking_guest_checkout');
}

function handleVideoUrl($string,$video_id = false)
{
    if($video_id && !empty($string)){
        parse_str( parse_url( $string, PHP_URL_QUERY ), $values );
        return $values['v'];
    }
    if (strpos($string, 'youtu') !== false) {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $string, $matches);
        if (!empty($matches[0])) return "https://www.youtube.com/embed/" . e($matches[0]);
    }
    return $string;
}

function is_api(){
    return request()->segment(1) == 'api';
}

function is_demo_mode(){
    return env('DEMO_MODE',false);
}
function credit_to_money($amount){
    return $amount * setting_item('wallet_credit_exchange_rate',1);
}

function money_to_credit($amount,$roundUp = false){
    $res = $amount / setting_item('wallet_credit_exchange_rate',1);

    if($roundUp) return ceil($res);

    return $res;
}

function clean_by_key($object, $keyIndex, $children = 'children'){
    if(is_string($object)){
        return clean($object);
    }

    if(is_array($object)){
        if(isset($object[$keyIndex])){
            $newClean = clean($object[$keyIndex]);
            $object[$keyIndex] =  $newClean;
            if(!empty($object[$children])){
                $object[$children] = clean_by_key($object[$children], $keyIndex);
            }

        }else{
            foreach($object as $key => $oneObject){
                if(isset($oneObject[$keyIndex])){
                    $newClean = clean($oneObject[$keyIndex]);
                    $object[$key][$keyIndex] =  $newClean;
                }

                if(!empty($oneObject[$children])){
                    $object[$key][$children] = clean_by_key($oneObject[$children], $keyIndex);
                }
            }
        }

        return $object;
    }
    return $object;
}
function periodDate($startDate,$endDate,$day = true,$interval='1 day'){
    $begin = new \DateTime($startDate);
    $end = new \DateTime($endDate);
    if($day){
        $end = $end->modify('+1 day');
    }
    $interval = \DateInterval::createFromDateString($interval);
    $period = new \DatePeriod($begin, $interval, $end);
    return $period;
}

function _fixTextScanTranslations(){
    return __("Show on the map");
}


function is_admin(){
    if(!auth()->check()) return false;
    if(auth()->user()->hasPermissionTo('dashboard_access')) return true;
    return false;
}
function is_vendor(){
    if(!auth()->check()) return false;
    if(auth()->user()->hasPermissionTo('dashboard_vendor_access')) return true;
    return false;
    }

function get_link_detail_services($services, $id,$action='edit'){
    if( \Route::has($services.'.admin.'.$action) ){
        return route($services.'.admin.'.$action, ['id' => $id]);
    }else{
        return '#';
    }

}

function get_link_vendor_detail_services($services, $id,$action='edit'){
    if( \Route::has($services.'.vendor.'.$action) ){
        return route($services.'.vendor.'.$action, ['id' => $id]);
    }else{
        return '#';
    }

}

function format_interval($d1, $d2 = ''){
    $first_date = new DateTime($d1);
    if(!empty($d2)){
        $second_date = new DateTime($d2);
    }else{
        $second_date = new DateTime();
    }


    $interval = $first_date->diff($second_date);

    $result = "";
    if ($interval->y) { $result .= $interval->format("%y years "); }
    if ($interval->m) { $result .= $interval->format("%m months "); }
    if ($interval->d) { $result .= $interval->format("%d days "); }
    if ($interval->h) { $result .= $interval->format("%h hours "); }
    if ($interval->i) { $result .= $interval->format("%i minutes "); }
    if ($interval->s) { $result .= $interval->format("%s seconds "); }

    return $result;
}
function generate_timezone_list()
    {
        static $regions = array(
            DateTimeZone::AFRICA,
            DateTimeZone::AMERICA,
            DateTimeZone::ANTARCTICA,
            DateTimeZone::ASIA,
            DateTimeZone::ATLANTIC,
            DateTimeZone::AUSTRALIA,
            DateTimeZone::EUROPE,
            DateTimeZone::INDIAN,
            DateTimeZone::PACIFIC,
        );

        $timezones = array();
        foreach( $regions as $region )
        {
            $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
        }

        $timezone_offsets = array();
        foreach( $timezones as $timezone )
        {
            $tz = new DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
        }

        // sort timezone by offset
        asort($timezone_offsets);

        $timezone_list = array();
        foreach( $timezone_offsets as $timezone => $offset )
        {
            $offset_prefix = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate( 'H:i', abs($offset) );

            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

            $timezone_list[$timezone] = "$timezone (${pretty_offset})";
        }

        return $timezone_list;
    }

    function is_string_match($string,$wildcard){
        $pattern = preg_quote($wildcard,'/');
        $pattern = str_replace( '\*' , '.*', $pattern);
        return preg_match( '/^' . $pattern . '$/i' , $string );
    }
    function getNotify()
    {
        $checkNotify = \Modules\Core\Models\NotificationPush::query();
        if(is_admin()){
            $checkNotify->where(function($query){
                $query->where('for_admin',1);
                $query->orWhere('notifiable_id', Auth::id());
            });
        }else{
            $checkNotify->where('for_admin',0);
            $checkNotify->where('notifiable_id', Auth::id());
        }
        $notifications = $checkNotify->orderBy('created_at', 'desc')->limit(5)->get();
        $countUnread = $checkNotify->where('read_at', null)->count();
        return [$notifications,$countUnread];
    }

    function is_enable_registration(){
        return !setting_item('user_disable_register');
    }
    function is_enable_vendor_team(){
        return false;
        return setting_item('vendor_team_enable');
    }

    function is_enable_plan(){
        return setting_item('user_plans_enable') == true;
    }

    function csv_get_contents(string $filepath): ?array {
        if (!file_exists($filepath) || !is_readable($filepath)) {
            throw new Exception("The file '$filepath' cannot be read.");
        }

        $handle = fopen($filepath, 'r');
        $contents = [];

        while (($data = fgetcsv($handle)) !== false) {
            $contents[] = $data;
        }

        fclose($handle);

        return $contents !== false ? $contents : null;
    }

    function csv_map_contents(array $lineContents, array $mappings, bool $multiLine = false): array {
        $mapped = [];

        if ($multiLine) {
            foreach ($lineContents as $contents) {
                $line = [];
                foreach ($contents as $index => $data) {
                    if (isset($mappings[$index])) {
                        $line[$mappings[$index]] = $data;
                    }
                }
                if (!empty($line)) {
                    $mapped[] = $line;
                }
            }
        } else {
            foreach ($lineContents as $index => $data) {
                if (isset($mappings[$index])) {
                    $mapped[$mappings[$index]] = $data;
                }
            }
        }

        return $mapped;
    }

    function download_save_media(string $url, string $dir = 'tmp/'): ?int {
        if (empty($url)) {
            return null;
        }
        
        if (strpos($url, '//drive.google.com') !== false) {
            return null;
        }

        if (Str::startsWith($url, 'demo/')) {
            $url = public_path('uploads/' . $url);
        }

        $name = Str::afterLast($url, '/');
        $path = $dir . $name;

        if (!Storage::disk('uploads')->exists($path)) {
            try {
                $contents = file_get_contents($url);
                Storage::disk('uploads')->put($path, $contents);
            } catch (\Exception $e) {
                return null;
            }
        }

        $mime = Storage::disk('uploads')->mimeType($path);
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $mediaData = [
            'file_name' => $name,
            'file_path' => $path,
            'file_type' => $mime,
            'file_extension' => $extension,
        ];
        $id = DB::table('media_files')->insertGetId($mediaData);

        return $id;
    }

    function svg_icon_set($iconName): string
    {
        switch ($iconName) {
            case 'montips':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#kgk24yl7qa)" >
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21 7.5a4.5 4.5 0 0 0-4.5 4.5c0 1.263.573 2.37 1.354 3.383.652.847 1.487 1.675 2.32 2.502.158.156.316.312.472.469a.5.5 0 0 0 .708 0l.47-.469h.001c.834-.827 1.669-1.655 2.321-2.502.78-1.013 1.354-2.12 1.354-3.383A4.5 4.5 0 0 0 21 7.5zm-1.645 4.389c0-.903.75-1.611 1.643-1.611.894 0 1.643.708 1.643 1.61 0 .904-.749 1.612-1.643 1.612s-1.643-.708-1.643-1.611z"/>
                    <path d="M9.81 11.96c.938-.111.706-1.286.473-1.86l-.038-.07c-.133-1.023.586-2.883 1.135-2.418.281.238 1.004.507 1.658.75.623.231 1.182.44 1.238.575.029.072.042.183.058.322.047.404.122 1.044.699 1.632l.059.06c-.06.34-.092.691-.092 1.05 0 1.738.794 3.166 1.665 4.298.714.927 1.609 1.813 2.416 2.613l.038.038.467.464a2 2 0 0 0 2.828 0l.467-.464.038-.038c.807-.8 1.702-1.686 2.416-2.613C26.206 15.167 27 13.739 27 12c0-.353-.03-.7-.089-1.036a.936.936 0 0 1 .196.252c.284.489.492.605.87.396.379-.21.776 0 .814.325.028.24-.261 1.032-.469 1.601-.075.205-.14.382-.174.492l-.084.271c-.065.21-.097.314-.181.52a.393.393 0 0 1-.123.174c-.056.048-.08.069-.01.314.114.396.398.489.53.256.133-.232.568-.256.833 0s.738.372.795 0c.057-.372.17-.604.7-.256.311.205.46.45.609.697.105.174.211.35.375.513.398.395.72 1.558-.113 1.116-.506-.268-.99.012-1.416.258-.275.16-.526.304-.742.277-.421-.054-.519.126-.824.685-.093.17-.204.374-.35.617-.338.567-.67.43-.932.324-.22-.09-.39-.16-.468.234-.17.86-1.305.954-1.552.86-.053-.02-.128-.08-.216-.153-.315-.26-.806-.664-1.146.154-.221.532-.012 1.034.143 1.405.15.359.248.595-.143.618-.365.021-.685.473-1.017.94-.392.552-.799 1.125-1.31 1.037-.947-.163-2.234.256-3.389.837-1.154.581-3.406.14-3.803-.465-.242-.367-1.097-.4-1.782-.426-.444-.017-.817-.032-.906-.132-.227-.256-2.025-.419-2.744-.256-.69.156-.735-.309-.821-1.188l-.012-.114c-.054-.547-.283-.72-.596-.955a3.168 3.168 0 0 1-.804-.813c-.41-.603-1.413-.75-2.257-.872-.555-.082-1.041-.152-1.244-.337-.312-.284-.208-.732-.071-1.323.087-.379.188-.815.203-1.305.033-1.085-1.318-1.927-1.919-2.3-.094-.06-.17-.107-.22-.142-.359-.256-1.362-1.767-1.097-1.814.127-.022.18-.2.23-.37.055-.181.106-.353.243-.304.182.064.374-.004.617-.09.11-.04.231-.083.367-.12.224-.06.417-.309.616-.566.19-.244.384-.494.614-.596.15-.067.377-.248.631-.451.546-.437 1.217-.974 1.527-.689.23.212.59.245.907.274.31.03.58.054.645.238.132.372.738 1.256 1.343 1 .284-.12.489-.02.747.105.293.142.654.318 1.278.244z"/>
                </g>
                <defs>
                    <clipPath id="kgk24yl7qa">
                        <path fill="#fff" d="M0 0h32v32H0z"/>
                    </clipPath>
                </defs>
            </svg>';
            case 'montour':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.014 19.901a12.7 12.7 0 0 1-1.234 2.89h2.574a2 2 0 0 0 .351.168 1.822 1.822 0 0 0 1.739-.26l.708-.481c-.314.694-.684 1.36-1.106 1.993a13.054 13.054 0 0 1-3.54 3.537c-.706.475-1.456.882-2.238 1.216-.802.344-1.636.606-2.491.78a13.629 13.629 0 0 1-5.276 0c-.84-.169-1.66-.423-2.449-.757l-.041-.015a13.643 13.643 0 0 1-2.239-1.216 12.965 12.965 0 0 1-2.683-2.405c.376-.323.77-.623 1.181-.9.197.227.4.446.61.656.523.526 1.098 1 1.715 1.413.632.422 1.302.784 2.001 1.083l.034.015a11.164 11.164 0 0 0 2.725.76 23.487 23.487 0 0 1-4.164-4.487H7.109c.78-.494 1.65-.976 2.511-1.429.065.112.133.222.203.33h4.753v-2.664l.364-.154c.172.331.446.598.78.763v2.053h4.73c1.13-1.772 1.739-3.558 1.822-5.353l.75 2.464h-.008zm-9.649-4.242c.177-.565.67-1.018 1.382-1.476l-2.436-2.847c-.164-.143-.122-.26.031-.362l.81-.346a.474.474 0 0 1 .393.05l3.537 1.782 4.164-2.407-5.757-7.158c-.148-.164-.127-.291.104-.374L16.895 2l8.651 5.593 3.123-1.517c1.19-.52 2.215-.604 2.863-.216a.754.754 0 0 1 .463.78c.013.781-.64 1.625-1.793 2.343l-3.245 1.265-.26 10.288-1.161.781c-.2.143-.318.091-.37-.125L22.48 12.42 18.15 14.5l-.521 3.904a.48.48 0 0 1-.19.359l-.737.474c-.17.067-.289.036-.312-.18l-.979-3.618c-.78.333-1.437.484-2.004.307-.052-.015-.057-.039-.042-.088zm-1.093-1.804c-3.44 1.822-8.042 4.781-9.734 6.507-5.533 5.697-1.215 10.138 5.25 8.193-2.025-.299-3.61-.708-4.49-1.285-3.756-2.468 8.329-7.793 11.155-8.959l-.22-.82a3.43 3.43 0 0 1-1.32-.138l-.16-.07a1.576 1.576 0 0 1-.923-.914l-.034-.09a1.583 1.583 0 0 1-.018-1.11 3.41 3.41 0 0 1 .627-1.163l-.127-.15h-.006zm-10.19 4.578a13.874 13.874 0 0 1 .172-4.229c.168-.84.42-1.66.755-2.45l.016-.038c.336-.783.744-1.533 1.218-2.241A12.964 12.964 0 0 1 7.78 5.938a13.642 13.642 0 0 1 2.238-1.216 12.885 12.885 0 0 1 2.491-.78 13.4 13.4 0 0 1 1.528-.214c.058.091.122.178.192.26l1.49 1.856V9.78h2.66l-1.352.781-2.451-1.233v-3.49a27.105 27.105 0 0 0-3.759 3.942h.347a1.783 1.783 0 0 0-.565.911 1.41 1.41 0 0 0-.044.209v.023h-.54a13.462 13.462 0 0 0-1.493 3.058c-.471.284-.945.573-1.413.87a13.188 13.188 0 0 1 1.561-3.938H5.086c-.26.447-.491.909-.695 1.384l-.015.034a10.96 10.96 0 0 0-.664 2.17 11.652 11.652 0 0 0-.213 1.776h1.447c-.992.669-1.948 1.39-2.863 2.16v-.003zm20.174-1.015h-2.813l.153-1.145h2.317l.346 1.145h-.003zm-1.174 6.47a23.643 23.643 0 0 1-4.164 4.49 11.314 11.314 0 0 0 2.756-.778c.7-.298 1.37-.66 2.002-1.083a11.288 11.288 0 0 0 1.715-1.413c.387-.378.747-.785 1.075-1.215h-3.384zm-5.366 4.017a24.416 24.416 0 0 0 3.966-4.016h-3.966v4.016zm-1.14-4.016h-3.97a24.527 24.527 0 0 0 3.97 4.016v-4.016zM9.412 9.779a26.177 26.177 0 0 1 4.05-4.479 10.932 10.932 0 0 0-2.858.791c-.7.299-1.37.662-2.002 1.083a11.28 11.28 0 0 0-1.715 1.413c-.374.372-.722.77-1.04 1.19l3.565.002z" />
            </svg>';
            case 'findfriend':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 27.413c.54-7.002 2.675-5.604 8.649-9.342.944 2.451 3.806 3.592 6.406 3.262a7.958 7.958 0 0 0-.244 6.08H1zm22.302-8.849a6.094 6.094 0 0 1 4.315 1.788 6.115 6.115 0 0 1 1.534 6.058 6.063 6.063 0 0 1-.62 1.403l1.901 2.114a.29.29 0 0 1-.017.412l-1.735 1.584a.29.29 0 0 1-.412-.018l-1.798-2.024a6.095 6.095 0 0 1-8.806-2.882 6.114 6.114 0 0 1 3.305-7.971 6.074 6.074 0 0 1 2.333-.464zm3.443 2.66a4.883 4.883 0 0 0-5.305-1.058c-3.248 1.344-3.994 5.532-1.581 7.942a4.885 4.885 0 0 0 5.305 1.059 4.868 4.868 0 0 0 3.006-4.501c0-.661-.13-1.29-.367-1.862a4.894 4.894 0 0 0-1.058-1.58zm-15.343-3.43c-.064-.114.203-.839.271-.953-.78-.695-1.397-1.396-1.528-2.837h-.084a1.13 1.13 0 0 1-.554-.145c-.28-.16-.476-.432-.609-.74-.281-.646-.504-2.134.204-2.62l-.133-.088-.015-.187a20.355 20.355 0 0 1-.041-1.19c-.076-4.74-3.9-2.772 1.685-7.168C11.835.89 13.092.243 14.323.056c1.265-.192 2.49.098 3.622 1.014.334.27.659.594.972.974 1.207.117 2.194.768 2.9 1.696.42.554.74 1.21.943 1.906.203.693.291 1.432.254 2.16-.069 1.302-.545 1.94-1.505 2.867.17.006.328.045.469.12.535.287.552.909.412 1.43-.14.437-.316.732-.483 1.157-.203.574-.499.68-1.071.619-.03 1.418-.685 2.115-1.567 2.948l.199.698-.008.032a7.939 7.939 0 0 0-1.795 1.346l-.006.007a7.8 7.8 0 0 0-.534.59c-2.012.51-4.72-.038-5.723-1.826z" />
            </svg>';
            case 'business':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.277 8.413H3.48v17.066H2.277A2.28 2.28 0 0 1 0 23.205V10.687a2.282 2.282 0 0 1 2.277-2.274zm17.087 18.652c-.138-.52.023-1.112.352-1.823l-3.262-1.003c-.197-.03-.22-.138-.153-.291l.456-.672a.443.443 0 0 1 .328-.154l3.597-.339 2.037-3.876-7.91-2.727c-.196-.055-.24-.161-.1-.341l.758-1.042 9.378.114 1.841-3.448c.664-.98 1.415-1.54 2.102-1.563a.69.69 0 0 1 .732.367c.388.6.295 1.563-.245 2.68l-2.068 3.319L32 24.341l-.521 1.172c-.083.208-.198.224-.344.083l-6.324-5.47-2.345 3.7 1.506 3.286a.432.432 0 0 1 .031.36l-.325.734c-.1.136-.206.17-.329 0l-2.51-2.302c-.443.635-.876 1.068-1.4 1.208-.046 0-.062 0-.075-.046zM10.641 4h4.527a2.566 2.566 0 0 1 2.56 2.56v1.368h-1.63V6.555a.901.901 0 0 0-.899-.898h-4.59a.901.901 0 0 0-.898.898v1.373H8.075V6.561A2.566 2.566 0 0 1 10.64 4zM4.829 8.413h16.03v3.805l-5.21-.065a2.658 2.658 0 0 0-2.344 1.084l-.708.956a2.745 2.745 0 0 0-.521 2.688 2.716 2.716 0 0 0 1.99 1.854l4.56 1.579-1.76.167c-.393.025-.777.129-1.13.304a3.11 3.11 0 0 0-.907.667c-.096.1-.183.208-.26.323l-.362.521c-.14.176-.255.37-.344.576a2.773 2.773 0 0 0-.164 1.935 2.506 2.506 0 0 0 .273.667H4.83V8.413zm17.382 0h1.506a2.266 2.266 0 0 1 1.55.604c-.258.28-.495.577-.709.89-.074.102-.14.208-.2.319l-1.079 2.02-1.057-.012V8.413h-.01z" />
            </svg>';
            case 'weather':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#c43z1st5ia)">
                    <path d="M7.068.063a1.007 1.007 0 0 0-.595 1.295l.568 1.533a1.007 1.007 0 1 0 1.89-.7L8.363.658A1.007 1.007 0 0 0 7.068.063zM9.216 10.456c1.075-1.71 3-3.691 6.32-4.324a6.67 6.67 0 0 0-10.384 8.081 8.141 8.141 0 0 1 2.868-1.16c.289-.913.69-1.785 1.197-2.597zM9.859 15.13s.807-7.292 8.501-6.92c7.695.373 7.696 6.92 7.696 6.92s5.864.03 5.771 5.864c0 0-.28 4.345-5.027 4.903H9.707s-2.951.248-4.844-2.482c-1.893-2.73-.62-8.192 4.996-8.285zM13.277 30.69a1.31 1.31 0 1 0 0-2.619 1.31 1.31 0 0 0 0 2.62zM19.245 30.69a1.31 1.31 0 1 1-2.62 0 1.31 1.31 0 0 1 2.62 0zM22.663 30.69a1.31 1.31 0 1 0 0-2.619 1.31 1.31 0 0 0 0 2.62zM.063 14.777a1.007 1.007 0 0 1 .595-1.295l1.533-.569a1.007 1.007 0 0 1 .7 1.89l-1.533.569a1.007 1.007 0 0 1-1.295-.595zM.747 5.867v.001a1.007 1.007 0 0 0 .368 1.376l1.416.818A1.007 1.007 0 1 0 3.54 6.316L2.123 5.5a1.007 1.007 0 0 0-1.376.368zM15.994.732c.493.26.682.869.422 1.36l-.762 1.448c-.26.492-.868.68-1.36.421h-.001a1.007 1.007 0 0 1-.422-1.36l.762-1.448c.26-.492.869-.68 1.36-.421z"/>
                </g>
                <defs>
                    <clipPath id="c43z1st5ia">
                        <path fill="#fff" d="M0 0h32v32H0z"/>
                    </clipPath>
                </defs>
            </svg>';
            case 'transport':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.897 27.084H24.47v2.29c0 .43-.17.844-.47 1.149a1.59 1.59 0 0 1-1.13.477h-.94c-.425 0-.832-.172-1.133-.477-.3-.305-.47-.718-.471-1.15v-2.289h-9.692v2.29c-.001.43-.17.843-.47 1.148-.3.305-.706.477-1.13.478h-.941a1.596 1.596 0 0 1-1.131-.478c-.3-.305-.47-.718-.472-1.149v-2.289h-1.22c-.834-.014-1.232-.466-1.296-1.267V7.144c-.465.045-.696.155-.808.401v5.353H2.15c-.305 0-.597-.124-.813-.343A1.181 1.181 0 0 1 1 11.73V8.575c.001-.303.118-.594.325-.812.208-.218.49-.345.788-.356.098-.917.487-1.18 1.89-1.25.186-1.6 1.257-2.783 3.215-3.549a42.484 42.484 0 0 1 5.678-.566L14.577 2h2.62l1.672.074c1.647.067 3.287.246 4.91.534 1.957.767 3.023 1.95 3.218 3.54 1.391.07 1.792.34 1.89 1.247.298.011.58.14.788.357.207.218.324.509.325.812v3.166c0 .31-.122.606-.337.825a1.143 1.143 0 0 1-.813.343h-1.013V7.545c-.114-.24-.345-.348-.81-.39v18.49c0 1.072-.34 1.453-1.13 1.45v-.01zM4.933 22.388l.064-1.585c.036-.283.18-.401.44-.359a30.66 30.66 0 0 1 3.754 2.41c.254.173.154.504-.18.442l-3.53-.263a.632.632 0 0 1-.399-.215.652.652 0 0 1-.157-.43h.008zm21.137 0-.067-1.585c-.036-.283-.18-.401-.437-.359a30.899 30.899 0 0 0-3.758 2.41c-.253.173-.15.504.184.442l3.53-.263a.634.634 0 0 0 .398-.216.654.654 0 0 0 .158-.43h-.008zM5.75 24.433a.58.58 0 0 1 .545.367.606.606 0 0 1-.127.652.585.585 0 0 1-.641.13.604.604 0 0 1-.19-.974.58.58 0 0 1 .413-.175zm19.28 0a.58.58 0 0 1 .328.1.595.595 0 0 1 .252.613.585.585 0 0 1-.802.435.604.604 0 0 1-.19-.974.58.58 0 0 1 .413-.174zm-11.742 0H17.8a.216.216 0 0 1 .156.066.222.222 0 0 1 .064.158v.767c0 .059-.023.116-.064.158a.218.218 0 0 1-.155.065h-4.507a.216.216 0 0 1-.157-.064.224.224 0 0 1-.066-.16v-.766a.227.227 0 0 1 .066-.16.218.218 0 0 1 .157-.064h-.005zM12.373 3.46h6.257c.1 0 .197.042.269.114.071.073.111.17.112.274V4.86c0 .103-.04.201-.112.274a.38.38 0 0 1-.27.114h-6.256a.378.378 0 0 1-.27-.114.39.39 0 0 1-.111-.274V3.848c0-.103.04-.201.112-.274a.381.381 0 0 1 .269-.114zM5.796 6.53H25.12c.122 0 .24.05.327.137a.481.481 0 0 1 .14.33v10.372c0 .26-.208.404-.467.475-6.627 2.046-12.698 1.96-19.325 0-.262-.07-.468-.215-.468-.475V6.996a.48.48 0 0 1 .288-.44.458.458 0 0 1 .18-.035v.009z" />
            </svg>';
            case 'shop':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.284 7.9h5.854V6.709a6.71 6.71 0 0 1 13.42 0v1.193h5.9a1.278 1.278 0 0 1 1.182.793c.064.156.097.322.097.49v18.204a4.623 4.623 0 0 1-4.61 4.61H6.61A4.622 4.622 0 0 1 2 27.39V9.187a1.278 1.278 0 0 1 .378-.906 1.279 1.279 0 0 1 .903-.378l.003-.002zm7.49 0H20.93V6.709a5.078 5.078 0 1 0-10.157 0v1.193zm-1.636 3.386v-1.75H3.635v16.146h24.48V9.536h-5.558v1.76a1.688 1.688 0 1 1-1.635-.03v-1.73H10.766v1.748a1.687 1.687 0 1 1-1.636 0l.008.002z" />
            </svg>';
            case 'beauty':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.992.88c2.018-1.367 4.32-1.065 6.219.383.5.383.925.851 1.263 1.42.287.484.794 1.473-.15 1.627-.37.057-1.02-.445-1.522-.61a9.778 9.778 0 0 0-1.961-.411c-1.221-.122-2.427-.023-3.461.263a11.04 11.04 0 0 0-1.63.586c-.243.115-.743.443-.876.018-.318-.987 1.394-2.784 2.118-3.276zm10.037 26.974 1.102-1.146-.995-.995-1.102 1.146.995.995zm1.352-.906-1.068 1.148c.58.581 3.31 3.527 3.404 3.433l1.1-1.065a.061.061 0 0 0 0-.086l-3.436-3.43zm3.818 3.284a.34.34 0 0 1 0 .477L26.006 31.9a.34.34 0 0 1-.48 0l-4.948-4.948c-.01-.01-.161-.06-.398-.136-1.018 1.118-2.188 2.006-3.461 2.475-1.32.49-2.748.523-4.222-.094-.763-.32-1.545-.82-2.323-1.521-.714-.643-1.36-1.44-1.946-2.37-.542-.857-1.029-1.834-1.474-2.907a3.927 3.927 0 0 1-1.245-.625c-.61-.468-1.016-1.107-1.253-1.81-.263-.781-.31-1.648-.203-2.445.055-.415.172-.774.341-1.073.185-.318.425-.573.732-.766a.474.474 0 0 1 .284-.073c-.17-.88-.143-1.724-.11-2.716.095-2.59.75-4.655 2.79-6.45 3.076-2.708 9.168-2.942 12.556-.611.503.346.969.758 1.39 1.237 1.376 1.578 2.6 5.042 2.574 7.178a5.088 5.088 0 0 1-.255 1.508c-.005.05-.018.104-.031.167.37.234.661.52.877.846.316.484.456 1.04.422 1.63-.034.563-.226 1.157-.575 1.738-.41.671-1.032 1.33-1.86 1.893a19.13 19.13 0 0 1-1.227 2.386l.316.893 4.922 4.925zm-8.011-3.724c-.896-.276-1.925-.592-2.115-.649a.14.14 0 0 1-.096-.156 4.908 4.908 0 0 1 1.377-2.701c.706-.706 1.607-1.17 2.568-1.232a.145.145 0 0 1 .143.104l.487 1.38c.308-.562.584-1.138.823-1.713a.493.493 0 0 1 .185-.219c.769-.505 1.329-1.083 1.686-1.67.268-.442.414-.887.44-1.302.02-.39-.066-.755-.269-1.065a1.8 1.8 0 0 0-.422-.448c-.354.802-.942 1.852-1.705 2.896v-4.787c-2.193-1.015-3.628-3.25-4.36-6.607-.875 6.394-8.728 6.115-10.7 7.282v3.73a17.361 17.361 0 0 1-1.012-1.605 7.64 7.64 0 0 1-.581-1.281l-.01.008c-.173.109-.31.255-.415.44-.114.195-.19.44-.229.729-.091.667-.05 1.388.164 2.026.177.537.482 1.016.933 1.362.161.12.33.227.515.313.19.088.393.161.615.216a.463.463 0 0 1 .323.281c.443 1.11.94 2.107 1.484 2.975.537.854 1.133 1.583 1.784 2.172.698.627 1.386 1.073 2.058 1.354 1.237.521 2.43.487 3.537.078 1.002-.367 1.943-1.044 2.792-1.911zm-5.665-2.22a.307.307 0 0 1 .393.19c.175.334 1.498.363 1.748-.018a.308.308 0 0 1 .568.24c-.446.878-2.527.854-2.896-.018a.308.308 0 0 1 .187-.393zm4.49-5.039-.357.44a.307.307 0 0 1-.432.05.31.31 0 0 1-.05-.435l.248-.308a.309.309 0 0 1 .354-.505c.237.156.633.24 1.052.235.396-.008.797-.097 1.086-.282a.306.306 0 0 1 .425.094.309.309 0 0 1-.096.427l-.03.018.277.305a.307.307 0 0 1-.023.438.304.304 0 0 1-.435-.024l-.428-.469a2.887 2.887 0 0 1-.442.084v.435c0 .169-.141.31-.31.31a.309.309 0 0 1-.31-.31v-.422a3.243 3.243 0 0 1-.529-.081zm-8.113.008-.349.43a.307.307 0 0 1-.435.046.307.307 0 0 1-.047-.432l.237-.294-.005-.008a.31.31 0 1 1 .347-.513c.234.156.614.245 1.028.247a.403.403 0 0 1 .081-.01c.024 0 .047.003.068.008.364-.016.734-.102 1.026-.274a.305.305 0 0 1 .422.115.303.303 0 0 1-.115.422l-.018.01.25.276a.31.31 0 1 1-.458.417l-.412-.45a3.032 3.032 0 0 1-.463.083v.416a.31.31 0 0 1-.62 0v-.409a2.334 2.334 0 0 1-.537-.08zm7.814-2.045a.309.309 0 0 1-.357-.502c.58-.412 1.174-.623 1.784-.628.607-.003 1.216.203 1.823.622a.31.31 0 0 1-.352.508c-.502-.343-.992-.515-1.471-.513-.48 0-.956.175-1.427.513zm-8.686 0a.309.309 0 0 1-.357-.502c.583-.412 1.175-.623 1.784-.628.61-.003 1.216.203 1.823.622a.31.31 0 0 1 .08.43.31.31 0 0 1-.429.078c-.503-.343-.995-.515-1.471-.513-.477 0-.951.175-1.43.513z" />
            </svg>';
            case 'exchange':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#qnnk5v43aa)" >
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.31 0a7.306 7.306 0 1 0 5.163 2.14A7.27 7.27 0 0 0 7.309 0zM4 3.5c0-.276.196-.5.438-.5h6.125c.241 0 .437.224.437.5s-.196.5-.438.5H7.938v2.11l1.137-.568c.221-.11.479.005.576.258.097.253-.004.547-.226.658l-1.488.744v.908l1.138-.568c.221-.11.479.005.576.258.097.253-.004.547-.226.658l-1.488.744V11.5c0 .276-.195.5-.437.5s-.438-.224-.438-.5V9.64l-1.137.568c-.221.11-.479-.005-.576-.258-.097-.253.004-.547.226-.658l1.487-.744V7.64l-1.137.568c-.221.11-.479-.005-.576-.258-.097-.253.004-.547.226-.658l1.487-.744V4H4.438C4.197 4 4 3.776 4 3.5z"/>
                    <path d="M27.843 14.607c.367-5.338-.453-8.618-6.288-8.618H20.7V4.364c0-.812-.193-.953-.782-.396l-3.166 3.01c-.383.362-.328.599.037.95l3.127 3.008c.547.552.78.396.78-.365V8.647c4.636-.292 4.563 2.165 4.483 4.875-.011.36-.022.723-.022 1.085h2.685zM4.11 16.807c-.368 5.338.452 8.616 6.288 8.616h.854v1.627c0 .813.19.953.78.396l3.167-3.01c.383-.362.328-.599-.037-.95l-3.124-2.997c-.547-.555-.781-.399-.781.364v1.914c-4.633.292-4.56-2.165-4.48-4.875.011-.359.022-.723.022-1.085H4.11zM22.602 26.18 22.264 25h.675l-.337 1.18zM24.602 22.82l.337 1.18h-.675l.338-1.18zM26.602 26.18 26.264 25h.675l-.337 1.18z"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.061 18.42a7.305 7.305 0 0 1 4.636-1.657 7.27 7.27 0 0 1 5.163 2.14 7.306 7.306 0 1 1-9.799-.484zm1.021 2.443a.5.5 0 1 0-.961.274L20.939 24h-.837a.5.5 0 1 0 0 1h1.122l.897 3.137a.5.5 0 0 0 .961 0L23.98 25h1.245l.897 3.137a.5.5 0 0 0 .961 0L27.98 25h1.123a.5.5 0 0 0 0-1h-.838l.818-2.863a.5.5 0 1 0-.961-.274L27.224 24H25.98l-.897-3.137a.5.5 0 0 0-.961 0L23.224 24H21.98l-.897-3.137z"/>
                </g>
                <defs>
                    <clipPath id="qnnk5v43aa">
                        <path fill="#fff" d="M0 0h32v32H0z"/>
                    </clipPath>
                </defs>
            </svg>';
            case 'wifi':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.084.005h9.881l.456-.003c.45-.005.676-.008.893.082.22.09.38.255.698.583l.312.32c.945.95 1.818 1.85 2.69 2.75.849.876 1.698 1.754 2.61 2.671.166.168.308.303.424.415.295.283.45.432.542.643.1.231.099.48.095 1.003v17.447c0 .41-.17.785-.44 1.056a1.49 1.49 0 0 1-1.056.44h-2.057v2.574a2.01 2.01 0 0 1-.593 1.421l.002.002a2.008 2.008 0 0 1-1.422.59H6.014a2.006 2.006 0 0 1-1.423-.59A2.005 2.005 0 0 1 4 29.986V5.572c0-.552.226-1.055.591-1.42l.005-.005a2.011 2.011 0 0 1 1.418-.59h2.574V1.501c0-.411.168-.785.44-1.056a1.49 1.49 0 0 1 1.056-.44zm13.6 27.407h-13.6c-.412 0-.786-.169-1.057-.44l-.01-.011a1.49 1.49 0 0 1-.43-1.045V5.005H6.015a.564.564 0 0 0-.4.164l-.002.003a.562.562 0 0 0-.165.4v24.414c0 .155.064.296.167.4a.564.564 0 0 0 .4.166h17.105a.562.562 0 0 0 .398-.166h.003a.563.563 0 0 0 .165-.4v-2.574zm-9.644-14.6h5.767v4.184l-.001.036V24.23l.002.036h-2.6v-7.25a.526.526 0 0 0-.526-.525h-4.238v-2.082c0-.879.719-1.597 1.596-1.597zm6.82 0h2.175c.878 0 1.596.72 1.596 1.597v2.097H20.86v-3.694zm3.771 4.747v1.895H20.86V17.56h3.772zm0 2.948v2.162c0 .877-.72 1.597-1.596 1.597h-2.177l.001-.036v-3.723h3.772zm-8.475 3.759H14.04a1.602 1.602 0 0 1-1.596-1.597V20.44h3.712v3.826zm-3.712-4.878v-1.846h3.712v1.846h-3.712z" />
            </svg>';
            case 'blog':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#53vprwkopa)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.281 10.44h25.2v11.388h-25.2V10.44zm2.487 8.394v-5.675h2.943c.543 0 .931.107 1.164.32a1.18 1.18 0 0 1 .352.925c.019.328-.06.655-.224.94-.138.212-.35.365-.594.43v.054c.73.127 1.097.626 1.099 1.498.019.397-.111.787-.365 1.093a1.406 1.406 0 0 1-1.114.415h-3.26zm2.524-2.253h-.709v.924h.7c.261 0 .381-.153.381-.46 0-.308-.125-.464-.372-.464zm-.136-2.17h-.573v.844h.565c.23 0 .344-.14.344-.421 0-.282-.112-.422-.336-.422zm6.82 4.428h-3.63v-5.68h1.823v4.221h1.823v1.454l-.015.005zm.433-2.834c0-1.041.193-1.796.58-2.263.386-.476 1.087-.713 2.097-.713s1.708.237 2.083.713c.375.477.581 1.23.581 2.263a5.9 5.9 0 0 1-.122 1.303 2.428 2.428 0 0 1-.422.916c-.212.268-.5.467-.826.57a4.026 4.026 0 0 1-1.302.183 4.01 4.01 0 0 1-1.302-.183 1.69 1.69 0 0 1-.825-.57 2.344 2.344 0 0 1-.422-.916 5.747 5.747 0 0 1-.123-1.303h.003zm1.95-.942v2.359h.753c.185.011.37-.018.542-.086.112-.057.166-.19.166-.396v-2.364h-.763a1.23 1.23 0 0 0-.52.086c-.113.057-.167.19-.167.395l-.01.006zm7.146 2.099v-.245h-.46v-1.378h2.187v3.021c-.714.272-1.471.41-2.235.409-1.041 0-1.752-.251-2.132-.753a2.344 2.344 0 0 1-.417-.916 6.125 6.125 0 0 1-.117-1.302 5.735 5.735 0 0 1 .122-1.303c.074-.333.225-.645.44-.911.4-.509 1.17-.763 2.313-.763.308.005.616.03.922.073.28.03.559.084.83.164l-.273 1.388a8.007 8.007 0 0 0-1.328-.128 2.683 2.683 0 0 0-.836.091.354.354 0 0 0-.24.365v2.57h.6c.161.01.323-.014.476-.067.099-.047.148-.151.148-.315zM2.167 3.56h27.666A2.172 2.172 0 0 1 32 5.727v20.539a2.175 2.175 0 0 1-2.167 2.167H2.167A2.172 2.172 0 0 1 0 26.266V5.726A2.172 2.172 0 0 1 2.167 3.56zm28.562 5.234H1.378v17.683a.596.596 0 0 0 .599.599h28.125a.597.597 0 0 0 .599-.6V8.795h.028zM27.771 5.44a1.07 1.07 0 1 1 0 2.141 1.07 1.07 0 0 1 0-2.14zm-7.25 0a1.07 1.07 0 1 1 0 2.141 1.07 1.07 0 0 1 0-2.14zm3.625 0a1.07 1.07 0 1 1 0 2.141 1.07 1.07 0 0 1 0-2.14zm-6.732 20.188a.914.914 0 0 1 0-1.823H27.74a.914.914 0 0 1 0 1.823H17.414zm-13.508 0a.917.917 0 0 1 0-1.823h9.563a.917.917 0 0 1 0 1.823H3.906z" />
                </g>
                <defs>
                    <clipPath id="53vprwkopa">
                        <path fill="#fff" transform="translate(0 3.56)" d="M0 0h32v24.872H0z"/>
                    </clipPath>
                </defs>
            </svg>';
            case 'daytour':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#kejzp2av8a)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M27.694 9.649a8.044 8.044 0 0 1-1.764 1.458.246.246 0 0 1-.283.008 9.896 9.896 0 0 1-2.45-2.188c-.894-1.12-1.457-2.362-1.65-3.557-.195-1.214-.012-2.38.592-3.33.24-.373.544-.717.914-1.011C23.904.352 24.876-.008 25.847 0c.932.008 1.854.354 2.651 1.08.281.256.516.545.708.863.649 1.07.79 2.432.503 3.815-.281 1.367-.979 2.755-2.015 3.89zM7.503 23.974a8.044 8.044 0 0 1-1.764 1.458.246.246 0 0 1-.283.008 9.947 9.947 0 0 1-2.451-2.187c-.89-1.117-1.453-2.36-1.646-3.558-.195-1.213-.013-2.38.591-3.328.237-.375.542-.716.914-1.01.852-.677 1.823-1.037 2.792-1.029.932.008 1.854.354 2.651 1.081.281.255.516.544.708.862.649 1.07.79 2.432.503 3.815-.281 1.365-.98 2.753-2.016 3.888zm-1.774 2.86c1.174 0 2.167.786 2.48 1.859h15.616c.771 0 1.474-.315 1.985-.826a2.797 2.797 0 0 0 0-3.968 2.797 2.797 0 0 0-1.985-.826h-5.463c-1.227 0-2.341-.5-3.149-1.307a4.443 4.443 0 0 1 0-6.297 4.443 4.443 0 0 1 3.149-1.307h4.94a2.584 2.584 0 1 1 .01 1.648h-4.95c-.771 0-1.474.315-1.985.825a2.797 2.797 0 0 0 0 3.97c.506.505 1.2.82 1.966.825h5.485c1.226 0 2.341.5 3.148 1.307a4.443 4.443 0 0 1 0 6.297 4.443 4.443 0 0 1-3.148 1.307H8.144a2.584 2.584 0 1 1-2.414-3.508zm-.258-10.35a2.083 2.083 0 1 1 .001 4.166 2.083 2.083 0 0 1 0-4.165zm20.19-14.328a2.083 2.083 0 1 1 .001 4.166 2.083 2.083 0 0 1 0-4.166z" />
                </g>
                <defs>
                    <clipPath id="kejzp2av8a">
                        <path fill="#fff" d="M0 0h32v32H0z"/>
                    </clipPath>
                </defs>
            </svg>';
            case 'package':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.147 17.107c.036-.224.112-.42.229-.583 1.344-.935 4.478-1.29 7.275-1.143v7.699c0 .512.165.989.444 1.38H.962c-.658-.185-.983-.556-.961-1.164l1.146-6.19zm22.214-4.873h2.142c.666 0 1.211.545 1.211 1.211v.647h-.772v-.65a.426.426 0 0 0-.424-.424h-2.172a.43.43 0 0 0-.086.009v-.789c.033-.002.067-.004.101-.004zm-.101 2.087h5.623V24.46h-6.067c.279-.391.444-.868.444-1.38v-8.76zm6.263 0h1.4A1.08 1.08 0 0 1 32 15.397v7.987a1.08 1.08 0 0 1-1.076 1.076h-1.401V14.32zM12.065 6h7.84a.165.165 0 0 1 .163.164v1.062a.165.165 0 0 1-.164.164h-1.177v2.667h-.694V7.39H14.01v2.667h-.693V7.39h-1.252a.165.165 0 0 1-.164-.164V6.164c0-.09.074-.164.164-.164zm.263 18.621v.439a.654.654 0 0 1-.652.652.654.654 0 0 1-.652-.652v-.439a1.546 1.546 0 0 1-1.527-1.541V11.91c0-.848.694-1.54 1.542-1.54h.353c0 .023.003.048.009.072l.387 1.47c.11.419.297.815.58 1.097.257.258.587.418.998.418h1.546v.828c0 .13.107.237.238.237h1.796c.13 0 .237-.106.237-.237v-.828h1.621c.418 0 .76-.164 1.023-.427.282-.282.468-.678.558-1.101l.31-1.452a.293.293 0 0 0 .01-.078h.167c.848 0 1.541.694 1.541 1.542V23.08c0 .843-.684 1.533-1.526 1.541v.439a.655.655 0 0 1-.652.652.654.654 0 0 1-.652-.652v-.439h-7.255zm7.74-13.966h-8.022l.293 1.112c.087.33.228.636.43.84a.82.82 0 0 0 .597.25h5.438c.252 0 .46-.1.62-.26.2-.201.336-.496.404-.817l.24-1.125zm-7.889 6.078a.286.286 0 1 1 0-.572h7.595a.285.285 0 1 1 0 .572H12.18zm0 5.515a.285.285 0 1 1 0-.571h7.595a.286.286 0 0 1 0 .571H12.18zm0-2.757a.286.286 0 1 1 0-.572h7.595a.286.286 0 1 1 0 .572H12.18zm-6.574-7.027h3.046v1.114h-2.95v1.335l-1.104.248v-1.688c0-.556.453-1.01 1.008-1.01z" />
            </svg>';
            case 'activity':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.135 5.031c.05 0 .097.008.141.021a.492.492 0 0 1 .367.477v6.177l5.32-5.32a.904.904 0 0 1 .646-.266c.232 0 .466.086.646.265l1.836 1.836a.289.289 0 0 1 .04.347c-.214.338-.293.74-.248 1.125.047.372.213.74.505 1.031.286.292.651.458 1.031.505.38.047.771-.034 1.112-.232a.288.288 0 0 1 .365.034l1.836 1.836c.18.18.265.412.265.646a.909.909 0 0 1-.265.646L18.643 27.247v.91c0 .27-.221.491-.492.491H1.411c-.388 0-.74-.158-.994-.414a1.412 1.412 0 0 1-.417-1V4.336c0-.08.018-.156.055-.224A1.506 1.506 0 0 1 1.508 3h16.627c.271 0 .493.221.493.492s-.222.492-.493.492H1.508a.53.53 0 0 0-.37.154.53.53 0 0 0-.154.37c0 .143.06.273.154.37a.52.52 0 0 0 .37.153h16.627zm.508 7.487v2.88c.07.014.151.032.245.055l.453-.453.417.417-.193.192.497.118.508-.508.42.419-.248.247.633.146 1.065-1.065c.148-.148.435-.11.633.089.198.198.24.484.088.633l-1.065 1.065.146.627.245-.245.42.42-.506.505.115.497.19-.19.419.42-.45.45.002.01c.216.948.024.651-.695 1.37l-1.042-2.703-1.031 1.031c.07.5.101.901-.292 1.295l-.44-.43c-.034-.211-.05-.362-.068-.471a.642.642 0 0 1-.307-.294l-.159-.019v4.43l1.498 1.497 8.505-8.508-6.964-6.966-3.039 3.04zm0 4.058v1.572c.17-.005.347.026.547.066l1.029-1.03-1.576-.608zm0 7.666v2.206l1.104-1.104-1.104-1.102zm10.399-8.19-6.966-6.966 2.294-2.294a.34.34 0 0 1 .247-.1c.086 0 .18.035.248.1l1.682 1.682a2.359 2.359 0 0 0-.214 1.292c.193 1.604 1.896 2.502 3.326 1.822l1.682 1.683a.34.34 0 0 1 .1.247c0 .086-.035.18-.1.248l-.008-.008-2.291 2.294zm-15.516.432c.016 0 .031 0 .044.003.1-.172.188-.354.271-.544.003-.003.003-.005.005-.01.123-.29.216-.592.276-.904.047-.242.081-.487.089-.742H12.75c-.026.742-.247 1.473-.659 2.192h1.432v.005h.003zm-.255.466h-1.469c-.445.649-1.05 1.284-1.802 1.917.117-.015.237-.034.352-.057.315-.063.62-.156.911-.284.297-.128.573-.276.833-.45.258-.172.495-.368.714-.586.17-.17.325-.347.466-.54h-.005zm-4.524 1.915c-.752-.63-1.354-1.269-1.802-1.917H5.477a4.807 4.807 0 0 0 1.18 1.125c.254.172.53.323.833.45.002.003.005.003.01.006a4.659 4.659 0 0 0 1.255.336h-.008zm-3.578-2.38h1.48c-.412-.722-.636-1.454-.66-2.193H4.53c.013.255.041.5.088.742.063.315.156.62.284.911.08.188.17.367.268.54zm-.64-2.66h1.468c.055-.726.297-1.458.727-2.192H5.167a5.198 5.198 0 0 0-.269.539l-.005.01a4.826 4.826 0 0 0-.365 1.643zm.945-2.66h1.552c.443-.639 1.026-1.28 1.753-1.923a4.51 4.51 0 0 0-1.295.344 5.322 5.322 0 0 0-.833.45 4.661 4.661 0 0 0-.713.586c-.17.17-.326.347-.467.54l.003.002zm4.492-1.923c.73.643 1.313 1.284 1.753 1.922h1.552a4.8 4.8 0 0 0-1.18-1.125 4.892 4.892 0 0 0-.833-.45c-.003-.003-.005-.003-.01-.006a4.66 4.66 0 0 0-1.287-.338v-.003h.005zm3.61 2.388h-1.558c.43.737.672 1.466.727 2.193h1.469a5.297 5.297 0 0 0-.089-.742 4.406 4.406 0 0 0-.284-.912 4.7 4.7 0 0 0-.265-.539zM8.305 8.846c.343-.07.7-.104 1.067-.104.368 0 .722.034 1.068.104a4.97 4.97 0 0 1 1.005.313c.318.138.623.302.907.492a5.181 5.181 0 0 1 1.427 1.427c.19.284.354.586.492.906.14.326.242.66.312 1.006.07.343.104.7.104 1.067s-.033.722-.104 1.068a4.965 4.965 0 0 1-.312 1.005 5.518 5.518 0 0 1-.492.907 5.18 5.18 0 0 1-1.427 1.427c-.284.19-.586.354-.907.492-.325.14-.659.242-1.005.312-.344.07-.7.104-1.068.104-.367 0-.721-.034-1.067-.104a4.964 4.964 0 0 1-1.006-.312 5.735 5.735 0 0 1-.906-.492 5.177 5.177 0 0 1-1.427-1.427 5.626 5.626 0 0 1-.492-.907 5.049 5.049 0 0 1-.313-1.005c-.07-.344-.104-.7-.104-1.068 0-.367.034-.721.104-1.067a4.969 4.969 0 0 1 .313-1.006c.138-.322.302-.622.492-.906a5.03 5.03 0 0 1 .643-.784c.24-.242.5-.455.784-.643.284-.19.586-.354.906-.492.326-.14.662-.242 1.006-.313zm1.3.698v1.62h1.543a11.166 11.166 0 0 0-1.544-1.62zm0 2.086v2.193h2.674c-.06-.721-.329-1.45-.808-2.193H9.604zm0 2.66v2.192h1.947c.464-.727.708-1.459.737-2.193H9.604zm0 2.66v1.639c.658-.542 1.202-1.092 1.622-1.638H9.604zM9.14 18.59V16.95H7.518c.417.546.959 1.096 1.623 1.637zm0-2.105v-2.192H6.456c.028.737.276 1.466.737 2.192H9.14zm0-2.659v-2.192H7.27c-.48.742-.748 1.474-.807 2.193H9.14zm0-2.66v-1.62a10.911 10.911 0 0 0-1.545 1.62h1.545zM5.883 25.296a.494.494 0 0 1-.492-.492c0-.271.221-.492.492-.492h6.862c.27 0 .492.22.492.492 0 .27-.221.492-.492.492H5.883zM3.88 22.719a.493.493 0 0 1 0-.984h10.87c.27 0 .492.22.492.492 0 .27-.221.492-.492.492H3.88zM17.66 6.016H1.508c-.185 0-.362-.034-.524-.094v21.312a.425.425 0 0 0 .427.427H17.66V6.017z" />
            </svg>';
            case 'restaurant':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#n37nqk0t1a)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24.111 28.6v-9.413h-4.234c-1.794.322-3.589 1.295-5.384 2.425h-3.288c-1.488.09-2.268 1.599-.822 2.59 1.153.845 2.674.797 4.234.657 1.075-.053 1.122 1.393 0 1.398-.39.03-.814-.061-1.183-.061-1.947-.002-3.55-.375-4.531-1.912l-.493-1.15-4.891-2.426c-2.448-.806-4.187 1.755-2.384 3.535a64.078 64.078 0 0 0 10.892 6.411c2.7 1.642 5.398 1.587 8.097 0l3.987-2.055zM1.378 19.49C.544 18.174.029 16.502-.281 14.343a.45.45 0 0 1 .18-.425c.072-1.62.855-2.484 2.345-3.017C2.378 9.734 3.3 8.918 4.43 8.723c1.565-1.59 4.122-2.065 6.188-1.272.071.027.294.14.495.24a.157.157 0 0 1 .059.046 4.462 4.462 0 0 1 2.28-.898 4.865 4.865 0 0 1 1.67.121l2.632-5.273c.24-.469.624-.917 1.37-.555.199.097.375.246.492.427.338.519.054.88-.204 1.327L16.564 7.61c.57.402 1.025.962 1.19 1.65.246.07.483.149.708.236l3.317-5.517c.277-.448.696-.864 1.41-.444.19.113.354.276.456.464.296.545-.016.883-.308 1.308l-3.463 4.927c1.258.883 2.052 2.253 1.702 3.83-.02.087.02.12.02.216l-.004.058c-.01.175-.025.35-.044.526a9.63 9.63 0 0 1-.823 3.032h-.848a.937.937 0 0 0-.158.013c.533-1.005.83-2.09.943-3.18H.685c.32 1.934.828 3.41 1.625 4.547-.33.028-.643.102-.932.214zm14.438-6.477a.448.448 0 1 1 0-.897h1.004a.448.448 0 1 1 0 .897h-1.005zm-.243-2.979a.448.448 0 0 1-.364.817l-.917-.412a.447.447 0 1 1 .365-.816l.916.411zm-5.104.302a.45.45 0 1 1 .338-.835l1.004.41a.451.451 0 0 1-.338.835l-1.004-.41zm-.346 2.677a.449.449 0 1 1 0-.897h1.004a.448.448 0 1 1 0 .897h-1.004zm-3.413-2.04a.448.448 0 0 1-.364-.816l.916-.412a.447.447 0 1 1 .365.817l-.917.412zm-1.978 2.04a.448.448 0 1 1 0-.897h1.005a.45.45 0 0 1 .448.449.449.449 0 0 1-.448.448H4.732zm-3.93.819h19.91c.431-2.096-1.734-3.351-3.457-3.778a.447.447 0 0 1-.338-.388c-.09-.87-.917-1.47-1.682-1.738a3.928 3.928 0 0 0-1.693-.199 3.56 3.56 0 0 0-1.976.84.445.445 0 0 1-.32.135c-.21 0-.712-.326-.947-.416-1.772-.68-4.02-.255-5.322 1.159a.446.446 0 0 1-.28.142c-.872.097-1.57.7-1.576 1.61a.449.449 0 0 1-.314.459C1.614 12.03.9 12.52.802 13.832zm1.663 2.047a.358.358 0 1 1 .673-.242c.244.678.556 1.332.932 1.947a.358.358 0 1 1-.611.373c-.4-.655-.735-1.357-.994-2.078zm1.602 2.969a.359.359 0 0 1 .57-.435c.293.383.613.739.972 1.062a.36.36 0 0 1-.48.533 8.65 8.65 0 0 1-1.062-1.16zm27.094-.565H25.94a.555.555 0 0 0-.554.554V28.99c0 .305.25.554.554.554h5.222c.304 0 .554-.25.554-.554V18.837a.555.555 0 0 0-.554-.554zm-2.611 1.71a.824.824 0 1 0 0 1.647.824.824 0 0 0 0-1.648z" />
                </g>
                <defs>
                    <clipPath id="n37nqk0t1a">
                        <path fill="#fff" d="M0 0h32v32H0z"/>
                    </clipPath>
                </defs>
            </svg>';
            case 'hotel':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#5iy3kq7ova)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.186 22.034a12.438 12.438 0 0 1-2.998 5.768 12.017 12.017 0 0 1-2.575 2.138.898.898 0 0 1-1.018.037 14.583 14.583 0 0 1-3.61-3.222A11.575 11.575 0 0 1 .54 21.458c-.3-1.849-.016-3.635.927-5.096A6.383 6.383 0 0 1 2.884 14.8a6.822 6.822 0 0 1 4.286-1.581 6.115 6.115 0 0 1 4.123 1.674c.433.392.807.843 1.111 1.341.993 1.641 1.214 3.714.782 5.8zm-2.084 7.575h20.446V10.365h-8.065v19.24h-.894V2.892H8.98v8.646h-.893V2.781a.781.781 0 0 1 .483-.72.781.781 0 0 1 .3-.061H22.7a.781.781 0 0 1 .554.23l.032.036a.781.781 0 0 1 .198.52v6.685h8.286a.644.644 0 0 1 .461.193.644.644 0 0 1 .193.461v19.93a.444.444 0 0 1-.448.445H10.087l.02-.018.024-.018.02-.019.024-.018.016-.013h.088l.016-.013v-.013H10.337l.015-.013h.045l.445-.51.029-.024h.015l.013-.013.013-.013.19-.206zm3.927-11.843h1.042a.154.154 0 0 1 .154.153v2.482a.156.156 0 0 1-.154.154h-.802c.03-.63.004-1.262-.078-1.888-.04-.3-.094-.597-.162-.888v-.013zm-.104 5.132h1.14a.154.154 0 0 1 .152.154v2.482a.151.151 0 0 1-.151.154h-2.162c.44-.89.782-1.826 1.021-2.79zm-1.302-10.265h2.448a.15.15 0 0 1 .151.15v2.483a.15.15 0 0 1-.15.153h-1.954l-.099-.166a8.857 8.857 0 0 0-.55-.808v-1.661a.15.15 0 0 1 .154-.151zm4.427 10.265h2.427a.154.154 0 0 1 .151.154v2.482a.153.153 0 0 1-.039.115.15.15 0 0 1-.112.049H18.03a.15.15 0 0 1-.153-.154v-2.492a.154.154 0 0 1 .153-.154h.021zm0-5.132h2.427a.15.15 0 0 1 .151.153v2.482a.154.154 0 0 1-.15.154h-2.449a.154.154 0 0 1-.153-.154v-2.482a.15.15 0 0 1 .094-.142.152.152 0 0 1 .06-.011h.02zm0-5.133h2.427a.151.151 0 0 1 .151.15v2.483a.152.152 0 0 1-.092.142.15.15 0 0 1-.059.011H18.03a.152.152 0 0 1-.142-.094.15.15 0 0 1-.011-.06v-2.481a.152.152 0 0 1 .095-.14.151.151 0 0 1 .058-.011h.021zm7.813 7.96h3.541c.042 0 .076.027.076.053v1.456c0 .026-.04.054-.076.054h-3.562c-.037 0-.076-.026-.076-.054v-1.456c0-.029.034-.052.076-.052h.02zM10.98 4.837h9.61a.362.362 0 0 1 .359.357v3.8a.362.362 0 0 1-.36.356H10.98a.362.362 0 0 1-.36-.357v-3.8a.36.36 0 0 1 .36-.356zm14.862 12.573h3.542c.041 0 .075.029.075.055v1.463c0 .026-.039.055-.075.055h-3.542c-.037 0-.076-.026-.076-.055v-1.463c0-.032.034-.055.076-.055zm0-3.17h3.542c.041 0 .075.03.075.055v1.453c0 .026-.039.055-.075.055h-3.542c-.037 0-.076-.023-.076-.055v-1.466c0-.031.034-.054.076-.054v.013zM6.904 16.816a2.956 2.956 0 1 1 .006 5.911 2.956 2.956 0 0 1-.006-5.91z" />
                </g>
                <defs>
                    <clipPath id="5iy3kq7ova">
                        <path fill="#fff" d="M0 0h32v32H0z"/>
                    </clipPath>
                </defs>
            </svg>';
            case 'translate':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.365 10.413c-.302.01-.529.073-.685.18a.544.544 0 0 0-.195.226.83.83 0 0 0-.065.365c.013.414.229.953.646 1.575l.005.008 1.36 2.162c.544.867 1.114 1.75 1.825 2.398.682.625 1.51 1.047 2.604 1.05 1.185.003 2.052-.435 2.758-1.094.732-.685 1.31-1.625 1.878-2.563l1.531-2.52c.287-.652.388-1.086.323-1.342-.039-.15-.206-.226-.492-.242-.06-.002-.123-.002-.188-.002-.067.002-.14.005-.213.012a.43.43 0 0 1-.117-.007 2.088 2.088 0 0 1-.42-.024l.524-2.32c-3.888.612-6.797-2.276-10.91-.578l.297 2.734c-.164.008-.32.003-.466-.018zm9.248 9.253c-.24-.323-.477-.672-.693-.99-.099-.145-.195-.284-.284-.411-.742.544-1.633.883-2.773.88-1.227-.002-2.172-.44-2.954-1.101l-.015.023c-.128.177-.271.385-.425.61-.27.398-.575.846-.877 1.229l-.417-.464c.266-.349.542-.75.786-1.112.16-.234.308-.453.433-.625a.286.286 0 0 1 .075-.073c-.659-.674-1.187-1.492-1.69-2.297l-1.36-2.159c-.497-.74-.755-1.42-.77-1.974-.008-.26.036-.5.133-.706.101-.219.258-.4.466-.541.099-.066.208-.123.328-.167a34.872 34.872 0 0 1-.065-3.883c.029-.294.086-.586.167-.88.346-1.24 1.218-2.24 2.294-2.925.38-.242.797-.443 1.234-.602.782-.283.401-1.479 1.269-1.497 2.028-.047 5.354 1.67 6.651 3.073.755.815 1.227 1.899 1.33 3.33l-.085 3.527c.378.115.617.354.716.74.11.427-.01 1.031-.372 1.857-.008.015-.013.028-.024.044l-1.547 2.55c-.596.981-1.203 1.968-2.01 2.724l-.034.03.315.46c.175.257.365.536.557.799l-.359.531zm-7.133 1.23c1.33.718 3.862 1.231 6.203.116l-2.648 3.844-3.555-3.96zm8.39-1.113c1.972.969 5.595 1.292 7.072 2.115a4.511 4.511 0 0 1 1.427 1.208c.982 1.297 1.067 5.764 1.422 7.355-.086.927-.612 1.46-1.646 1.539H17.94l1.698-1.076c.602-.38.617-.69.24-1.263l-2.709-4.13.086-.112 3.615-5.636zm-5.018 12.214H2.357C1.323 31.92.797 31.385.71 30.458c.357-1.591.44-6.057 1.422-7.354.393-.521.883-.907 1.427-1.209 1.333-.744 4.414-1.078 6.454-1.849l4.8 5.373c.036.057.075.11.111.161l-1.729 1.102c-.292.208-.378.513-.203.932l2.86 4.383zm-.453-5.922c.414.305.831.276 1.245-.023.057-.016.115-.034.175-.055a.817.817 0 1 1-1.61 0c.06.031.125.057.19.078z" />
                </svg>';
            case 'vehicle':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#chgo47qb2a)"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.076 14.44c-2.858-1.452-2.53-3.071.341-2.891l.656 1.194 1.302-4.12C5.895 7 6.773 5.53 8.472 5.53h.378v-.459a1.072 1.072 0 0 1 2.145 0v.459h10.854v-.459a1.072 1.072 0 0 1 2.145 0v.459h1.423c1.7 0 2.679 1.442 3.09 3.09l.994 3.995.573-1.078c2.952-.172 3.215 1.544.091 3.025l.52.78c2.054 2.112 1.862 4.22 1.542 9.434v1.712a.968.968 0 0 1-.966.966h-4.133a.968.968 0 0 1-.966-.966v-1.145h-13.35c-.058.33-.218.634-.459.867-.308.3-.722.468-1.153.468H9.828a1.643 1.643 0 0 1-1.153-.468 1.588 1.588 0 0 1-.46-.867H6.676v1.132a.968.968 0 0 1-.965.966H1.6a.968.968 0 0 1-.966-.955V24.26a1.42 1.42 0 0 1 0-.15c-.302-4.001-.742-7.617 2.441-9.67zm6.752 9.702H11.2a.951.951 0 0 1 0 1.9H9.828a.949.949 0 1 1 0-1.9zm-5.466-7.893a.898.898 0 0 1 .896.893v1.955a.898.898 0 0 1-1.24.827.897.897 0 0 1-.559-.827v-1.955a.895.895 0 0 1 .893-.893h.01zm7.028.206H21.47a.492.492 0 0 1 .492.492v2.343a.492.492 0 0 1-.492.492H11.374a.492.492 0 0 1-.492-.492v-2.343a.492.492 0 0 1 .492-.492h.016zM28.497 22.2s2.027 2.517 2.223 2.9h-2.226v-1.922H4.364V25.1H2.14l2.226-2.897 24.132-.002zm0-5.95a.896.896 0 0 1 .892.892v1.955a.896.896 0 0 1-1.793 0v-1.955a.898.898 0 0 1 .895-.893h.006zM5.44 13.645h22.598l-.996-4.143c-.26-1.263-1.06-2.343-2.343-2.343H9.034c-1.301 0-1.957 1.122-2.342 2.356l-1.257 4.136.005-.005z"/></g>
                    <defs>
                        <clipPath id="chgo47qb2a">
                            <path fill="#fff" d="M0 0h32v32H0z"/>
                        </clipPath>
                    </defs>
                </svg>';
            case 'hotelinfo':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#cm2v5yxzba)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M.14 28.286h3.84V5.951c0-.211.174-.386.388-.386h.776l.367-1.497-1.422-1.203 1.857-.138L6.652 1l.705 1.724 1.857.138-1.422 1.203.368 1.5c1.114 0 2.216.003 3.307.003l.367-1.503-1.422-1.203 1.857-.138L12.98 1l.703 1.724 1.857.138-1.422 1.203.37 1.506 3.305.005.37-1.51-1.422-1.204 1.857-.138L19.306 1l.706 1.724 1.857.138-1.422 1.203.37 1.513c1.091 0 2.19.003 3.302.003l.37-1.516-1.422-1.203 1.857-.138L25.632 1l.706 1.724 1.857.138-1.422 1.203.372 1.519h.771c.214 0 .386.174.386.385v22.315h3.839v2.471h-32v-2.469zm5.43-22.72h2.165l-1.083-.67-1.081.67zm6.319.005 2.182.002-1.093-.677-1.089.675zm6.316.008 2.208.002-1.107-.685-1.101.683zm6.315.005h2.224l-1.112-.688-1.112.688zM7.43 22.96h2.193c.07 0 .13.057.13.13v2.212a.13.13 0 0 1-.13.13H7.43a.13.13 0 0 1-.13-.13V23.09a.132.132 0 0 1 .13-.13zm15.074 0h2.193c.07 0 .13.057.13.13v2.212a.13.13 0 0 1-.13.13h-2.193a.13.13 0 0 1-.13-.13V23.09c0-.073.058-.13.13-.13zm-3.833-7.964h2.193c.07 0 .13.057.13.13v2.211a.13.13 0 0 1-.13.13H18.67a.13.13 0 0 1-.13-.13v-2.21c0-.071.057-.131.13-.131zm3.833 0h2.193c.07 0 .13.057.13.13v2.211a.13.13 0 0 1-.13.13h-2.193a.13.13 0 0 1-.13-.13v-2.21c0-.071.058-.131.13-.131zm0 3.982h2.193c.07 0 .13.057.13.13v2.211a.13.13 0 0 1-.13.13h-2.193a.13.13 0 0 1-.13-.13v-2.21c0-.071.058-.131.13-.131zm-3.833 0h2.193c.07 0 .13.057.13.13v2.211a.13.13 0 0 1-.13.13H18.67a.13.13 0 0 1-.13-.13v-2.21c0-.071.057-.131.13-.131zm0 3.982h2.193c.07 0 .13.057.13.13v2.212a.13.13 0 0 1-.13.13H18.67a.13.13 0 0 1-.13-.13V23.09c0-.073.057-.13.13-.13zm-7.407-7.964h2.193c.07 0 .13.057.13.13v2.211a.13.13 0 0 1-.13.13h-2.193a.13.13 0 0 1-.13-.13v-2.21c0-.071.06-.131.13-.131zm-3.834 0h2.193c.07 0 .13.057.13.13v2.211a.13.13 0 0 1-.13.13H7.43a.13.13 0 0 1-.13-.13v-2.21c.003-.071.06-.131.13-.131zm0 3.982h2.193c.07 0 .13.057.13.13v2.211a.13.13 0 0 1-.13.13H7.43a.13.13 0 0 1-.13-.13v-2.21c.003-.071.06-.131.13-.131zm3.834 0h2.193c.07 0 .13.057.13.13v2.211a.13.13 0 0 1-.13.13h-2.193a.13.13 0 0 1-.13-.13v-2.21c0-.071.06-.131.13-.131zm0 3.982h2.193c.07 0 .13.057.13.13v2.212a.13.13 0 0 1-.13.13h-2.193a.13.13 0 0 1-.13-.13V23.09c0-.073.06-.13.13-.13zM6.378 7.865h1.227v1.43h1.344v-1.43h1.234v4.094H8.95V10.3H7.605v1.66H6.378V7.864zm4.464 2.05c0-.67.18-1.188.542-1.56.362-.373.864-.558 1.513-.558.661 0 1.172.183 1.531.55.36.367.537.878.537 1.537 0 .479-.078.87-.235 1.177a1.717 1.717 0 0 1-.68.716c-.296.172-.664.255-1.106.255-.448 0-.82-.073-1.115-.221a1.703 1.703 0 0 1-.713-.698c-.18-.32-.274-.719-.274-1.198zm1.23.005c0 .412.075.711.223.89.151.18.354.271.612.271.263 0 .47-.088.615-.265.146-.177.219-.495.219-.953 0-.386-.076-.667-.227-.844a.769.769 0 0 0-.614-.268.746.746 0 0 0-.6.27c-.153.183-.229.482-.229.899zm3.132-2.055h3.74v1.013H17.69v3.084h-1.227V8.878h-1.255V7.865h-.003zm4.29 0h3.29v.875h-2.056v.651h1.907v.836h-1.907v.808h2.118v.927h-3.352V7.865zm4.013 0h1.227v3.089h1.922v1.008h-3.149V7.865zm-6.383 5.428h9.253c.154 0 .279.148.279.33v13.343c0 .182-.125.33-.279.33h-9.253c-.154 0-.279-.148-.279-.33v-13.34c0-.185.125-.333.279-.333zm-11.259-.019h9.253c.154 0 .28.149.28.331v13.36c0 .183-.126.331-.28.331H5.865c-.154 0-.279-.148-.279-.33v-13.36c0-.183.125-.332.279-.332z"/>
                    </g>
                    <defs>
                        <clipPath id="cm2v5yxzba">
                            <path fill="#fff" d="M0 0h32v32H0z"/>
                        </clipPath>
                    </defs>
                </svg>';
            case 'tourinfo':
                return '<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.678 19.047a.422.422 0 0 1-.484.016 16.992 16.992 0 0 1-4.203-3.75A13.356 13.356 0 0 1 9.163 9.21c-.336-2.08-.016-4.08 1.026-5.708a7.03 7.03 0 0 1 1.562-1.735A7.612 7.612 0 0 1 16.533 0a6.77 6.77 0 0 1 4.547 1.854c.472.433.88.931 1.213 1.48 1.112 1.822 1.352 4.166.862 6.541a14.398 14.398 0 0 1-6.477 9.172zm-4.947.193v7.245l7.851 3.385v-9.33a16.985 16.985 0 0 0 1.68-1.467v10.724l6.51-3.279V11.935l-2.502.964c.251-.664.458-1.343.62-2.034l2.421-.935a.838.838 0 0 1 1.128.789v16.328a.841.841 0 0 1-.52.781l-8.126 4.081a.842.842 0 0 1-.76 0l-9.115-3.95-7.844 3.95a.84.84 0 0 1-1.219-.747V13.865a.84.84 0 0 1 .605-.808l4.265-1.645c.159.536.346 1.064.563 1.58l-3.75 1.446v15.364l6.51-3.278V17.47a19.858 19.858 0 0 0 1.683 1.769zM16.218 3.7a3.573 3.573 0 1 1 0 7.146 3.573 3.573 0 0 1 0-7.145z"/>
            </svg>';
            case 'food':
                return '
                <svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.34 15.62c0 2.584-.909 4.79-2.729 6.61-1.823 1.823-4.026 2.734-6.609 2.734-2.573 0-4.776-.909-6.601-2.734-1.823-1.82-2.74-4.026-2.74-6.61 0-2.575.914-4.77 2.74-6.598 1.83-1.823 4.03-2.74 6.601-2.74 2.583 0 4.786.915 6.61 2.74 1.817 1.828 2.728 4.023 2.728 6.599zM4.263 13.9c.82-.56 1.232-1.292 1.161-2.967V6.63c-.008-.602-1.099-.675-1.153 0l-.042 3.492c-.003.653-.984.674-.982 0l.042-3.612c-.013-.646-1.055-.71-1.068 0 0 1.003-.041 2.61-.041 3.612.052.633-.86.716-.836 0l.041-3.589c-.023-.486-.56-.66-.924-.432-.388.248-.31.745-.326 1.164L0 11.384c.02 1.198.336 2.172 1.273 2.586.144.062.342.112.57.146l-.322 10.046a1.054 1.054 0 0 0 1.039 1.083h.13c.643 0 1.187-.55 1.17-1.218l-.285-9.914c.3-.047.547-.117.688-.214zm23.533 9.96-.016-9.023c-3.164-1.828-2.156-8.872 1.01-8.833 3.85.044 4.305 7.937.995 8.804l.245 9.088c.047 1.72-2.232 1.878-2.234-.036zm-6.357-8.247c0 1.505-.528 2.789-1.593 3.854-1.063 1.06-2.347 1.594-3.852 1.594-1.495 0-2.778-.534-3.84-1.594-1.063-1.065-1.595-2.349-1.595-3.854 0-1.495.532-2.779 1.594-3.838 1.065-1.06 2.346-1.594 3.841-1.594 3.024.002 5.445 2.406 5.445 5.432zm1.274 0c0-1.849-.651-3.43-1.961-4.74s-2.896-1.96-4.758-1.96c-1.857 0-3.437.65-4.74 1.96-1.309 1.31-1.968 2.891-1.968 4.74 0 1.854.659 3.435 1.969 4.75 1.302 1.312 2.882 1.971 4.74 1.971 1.859 0 3.444-.659 4.757-1.971 1.307-1.318 1.96-2.899 1.96-4.75z"/>
                </svg>';
            case 'finance':
                return '
                <svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="m21.755 29.102 1.266-6.425 1.281 1.932c2.76-1.109 4.31-2.935 4.542-5.747 2.268 3.964.89 7.518-1.982 9.599l1.307 1.969-6.414-1.328zM1.281 22.539 19.48 4.341l9.461 9.461L10.742 32l-9.46-9.46zm11.052-7.154a3.937 3.937 0 0 1 5.57 0 3.937 3.937 0 0 1 0 5.57 3.937 3.937 0 0 1-5.57 0 3.933 3.933 0 0 1 0-5.57zm-6.57 5.553 12.099-12.1c.77.771 2.026.771 2.794 0l3.742 3.74c-.77.771-.77 2.026 0 2.794L12.3 27.474a1.977 1.977 0 0 0-2.795 0l-3.742-3.74a1.98 1.98 0 0 0 0-2.797zm8.003-19.61L12.5 7.753 11.219 5.82c-2.76 1.11-4.31 2.935-4.542 5.748-2.268-3.964-.89-7.519 1.982-9.6L7.354 0l6.412 1.328z"/>
                </svg>';
            default: return '';
        }
    }