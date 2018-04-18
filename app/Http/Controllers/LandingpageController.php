<?php
/**
 * Brain Train - Find the job you love!
 * Copyright (c) Brain Train Kenya. All Rights Reserved
 *
 * Website: http://www.braintrainke.com
 *
 * CODED WITH LOVE
 * ---------------
 *  @author : Wanekeya Sam
 *  Title   : Full-stack Developer
 *  created : 02 September, 2017
 *  version : 1.0
 *  website : https://www.wanekeyasam.co.ke
 *  Email   : contact@wanekeyasam.co.ke
 */

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use ChrisKonnertz\OpenGraph\OpenGraph;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use App\Helpers\Localization\Country as CountryLocalization;
use App\Helpers\Localization\Language as LanguageLocalization;
use App\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use Torann\LaravelMetaTags\Facades\MetaTag;
use Crypt;

class LandingpageController extends Controller
{
    public function showLandingPage(){
        
        return view('landing');
    }

}
