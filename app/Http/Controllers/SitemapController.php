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

use App\Models\Category;
use App\Models\City;
use Torann\LaravelMetaTags\Facades\MetaTag;

class SitemapController extends FrontController
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index()
    {
        $data = array();
        
        // Get Categories
        $cats = Category::where('translation_lang', $this->lang->get('abbr'))->orderBy('lft')->get();
        $cats = collect($cats)->keyBy('translation_of');
        $cats = $sub_cats = $cats->groupBy('parent_id');

        if ($cats->has(0)) {
            $col = round($cats->get(0)->count() / 3, 0, PHP_ROUND_HALF_EVEN);
            $col = ($col > 0) ? $col : 1;
            $data['cats'] = $cats->get(0)->chunk($col);
            $data['sub_cats'] = $sub_cats->forget(0);
        } else {
            $data['cats'] = collect([]);
            $data['sub_cats'] = collect([]);
        }
        
        // Location sitemap
        $limit = 100;
        $cities = City::where('country_code', $this->country->get('code'))->take($limit)->orderBy('population', 'DESC')->get();
        
        $col = round($cities->count() / 4, 0, PHP_ROUND_HALF_EVEN);
        $col = ($col > 0) ? $col : 1;
        $data['cities'] = $cities->chunk($col);
        
        // Meta Tags
        MetaTag::set('title', t('Sitemap :country', ['country' => $this->country->get('name')]));
        MetaTag::set('description', t('Sitemap :domain - :country. 100% Free Job Board', ['domain' => getDomain(), 'country' => $this->country->get('name')]));
        
        return view('sitemap.index', $data);
    }
}
