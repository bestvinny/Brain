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

namespace App\Http\Controllers\Ajax;

use App\Models\City;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;

class AutocompleteController extends FrontController
{
    /**
     * AutocompleteController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sub-Location => Cities
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities()
    {
        $query = Input::get('query');
        $suggestions = [];

        if (strlen($query) > 0) {
            $cities = Cache::remember(md5($this->country->get('code') . '-citiesStartWith-' . $query), $this->cache_expire, function () use ($query) {
                return City::where('country_code', $this->country->get('code'))->where(function ($sql) use ($query) {
                    $sql->where('name', 'LIKE', $query . '%');
                    $sql->orWhere('name', 'LIKE', '%' . $query);
                })->orderBy('name')->get(['id as data', 'name as value'])->take(25)->toArray();
            });

            if (!is_null($cities)) {
                $suggestions = $cities;
            }
        }
        $result = [
            'query'       => $query,
            'suggestions' => $suggestions,
        ];

        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
