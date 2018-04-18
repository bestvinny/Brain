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

use App\Http\Controllers\FrontController;
use App\Helpers\Arr;
use App\Models\Language;
use \Illuminate\Support\Facades\Response;

class JsonController extends FrontController
{
	/**
	 * @return mixed
	 */
    public function getCountries()
    {
        exit(); // Moved to Post Ad's view
        $content = 'var countries = ' . (($this->countries) ? $this->countries->toJson() : '{}');
        $response = Response::make($content, 200);
        
        //$response->header('Content-Type', 'application/javascript'); // Don't active if file_get_contents() is used.
        return $response;
    }

	/**
	 * @return mixed
	 */
    public function getCategories()
    {
        exit();
        $categories = Language::find($this->country->lang->code)->categories()->where('parent_id', '=', 0)->orderBy('categories.lft')->get();
        
        $content = 'var categories = ' . (($categories) ? $categories->toJson() : '{}');
        $response = Response::make($content, 200);
        $response->header('Content-Type', 'application/javascript');
        
        return $response;
    }

	/**
	 * @return mixed
	 */
    public function getSubCategories()
    {
        exit();
        $sub_categories = Language::find($this->country->lang->code)->categories()->where('parent_id', '!=', 0)->orderBy('categories.lft')->get();
        
        $sub_categories = ($sub_categories) ? collect(Arr::groupBy($sub_categories->toArray(), 'id', false)) : false;
        $content = 'var subCategories = ' . (($sub_categories) ? $sub_categories->toJson() : '{}');
        $response = Response::make($content, 200);
        $response->header('Content-Type', 'application/javascript');
        
        return $response;
    }
}
