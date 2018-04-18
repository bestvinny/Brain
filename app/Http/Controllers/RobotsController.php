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

namespace App\Http\Controllers;

use App\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use App\Helpers\Localization\Country as CountryLocalization;

class RobotsController extends FrontController
{
    public function index()
    {
        error_reporting(0);
        $robots_txt = @file_get_contents('robots.txt');
        
        // Get countries list
        $countries = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        
        // Sitemaps
        if (!$countries->isEmpty()) {
            foreach ($countries as $item) {
                $country = CountryLocalization::getCountryInfo($item->get('code'));
                $robots_txt .= "\n" . 'Sitemap: ' . url($country->get('lang')->get('abbr') . '/' . $country->get('icode') . '/sitemaps.xml');
            }
        }
        
        // Rending
        header("Content-Type:text/plain");
        echo $robots_txt;
    }
}
