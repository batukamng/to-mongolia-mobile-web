<?php
/**
 * Created by PhpStorm.
 * User: dunglinh
 * Date: 6/8/19
 * Time: 22:06
 */

namespace App\Traits;

trait HasTranslations{

    public function trans($locale = false){
        return $this->translateOrOrigin($locale ?  $locale : app()->getLocale() );
    }
}
