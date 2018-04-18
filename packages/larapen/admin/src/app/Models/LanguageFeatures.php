<?php
/**
 * Brain Train - Find the job you love!
 * Copyright (c) Brain Train Kenya. All Rights Reserved
 *
 * Website: http://www.braintrainke.com
 *
 * CODED WITH LOVE
 * ---------------
 * 	@author : Wanekeya Sam
 *  Title   : Full-stack Developer
 * 	created	: 02 September, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
 */


namespace Larapen\Admin\app\Models;

use Illuminate\Support\Facades\Request;

trait LanguageFeatures
{
    public static function getActiveLanguagesArray()
    {
        $active_languages = self::where('active', 1)->get()->toArray();
        $localizable_languages_array = [];

        if (count($active_languages)) {
            foreach ($active_languages as $key => $lang) {
                $localizable_languages_array[$lang['abbr']] = $lang;
            }

            return $localizable_languages_array;
        }

        return config('laravellocalization.supportedLocales');
    }

    public static function findByAbbr($abbr = false)
    {
        return self::where('abbr', $abbr)->first();
    }
}