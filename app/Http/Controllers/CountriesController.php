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

use Illuminate\Support\Facades\View;
use App\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use App\Helpers\Localization\Country as CountryLocalization;
use Torann\LaravelMetaTags\Facades\MetaTag;
use Illuminate\Http\Request as HttpRequest;

class CountriesController extends FrontController
{
    /**
     * CountriesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return View
     */
    public function index()
    {
        $data = [];

        // Countries
        $countries = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));

        // Bootstrap grid view
        $cols = round($countries->count() / 4, 0, PHP_ROUND_HALF_EVEN);
        $cols = ($cols > 0) ? $cols : 1; // Fix array_chunk with 0
        $data['country_cols'] = $countries->chunk($cols)->all();

        // SEO
        $title = t('Jobs in the World');
        $description = t('Welcome to :app_name : 100% Free Job Board', ['app_name' => mb_ucfirst(config('settings.app_name'))]);
        $lang = ($this->country->has('lang') and isset($this->country->get('lang')->code)) ? $this->country->get('lang')->code : 'en';

        // Meta Tags
        MetaTag::set('title', $title);
        MetaTag::set('description', str_limit(str_strip($description), 200));

        // Open Graph
        $this->og->title($title)->description(str_limit(str_strip($description), 200))->url('/')->image(asset('images/cover-home-' . $lang . '.png'),
            [
                'width'  => 600,
                'height' => 600,
            ]);
        view()->share('og', $this->og);

        return view('countries', $data);
    }
}
