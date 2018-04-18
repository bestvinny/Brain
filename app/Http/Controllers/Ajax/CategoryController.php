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

use App\Models\Category;
use App\Http\Controllers\FrontController;
use Illuminate\Http\Request;

class CategoryController extends FrontController
{
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function getSubCategories(Request $request)
    {
        $language_code = $request->input('language_code');
        $parent_id = $request->input('cat_id');
        
        // Get Sub-categories by category ID
        $sub_categories = Category::where('parent_id', $parent_id)->where('translation_lang', $language_code)->orderBy('lft')->get();
        
        // Select the parent category if his haven't any sub-categories
        if ($sub_categories->count() <= 0) {
            $sub_categories = Category::where('id', $parent_id)->where('translation_lang', $language_code)->orderBy('lft')->get();
        }
        
        if ($sub_categories->count() <= 0) {
            return response()->json(['error' => ['message' => t("Error. Please select another category.")], 404]);
        }
        
        return response()->json(['data' => $sub_categories], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
