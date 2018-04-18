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
 * 	created	: 01 September, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
 */

namespace App\Http\Middleware;

use Closure;
use Mews\Purifier\Facades\Purifier;

class TransformInput
{
	/**
	 * @param $request
	 * @param Closure $next
	 * @return mixed
	 */
    public function handle($request, Closure $next)
    {
        if (in_array(strtolower($request->method()), ['post', 'put', 'patch'])) {
            $this->proccessBeforeValidation($request);
        }
        
        return $next($request);
    }

	/**
	 * @param $request
	 */
    public function proccessBeforeValidation($request)
    {
        $input = $request->all();

        if ($request->has('description')) {
            if (config('settings.simditor_wysiwyg') || config('settings.ckeditor_wysiwyg')) {
                $input['description'] = Purifier::clean($request->input('description'));
            } else {
                $input['description'] = str_clean($request->input('description'));
            }
        }

        if ($request->has('salary_min')) {
            $input['salary_min'] = str_replace(',', '.', $request->input('salary_min'));
            $input['salary_min'] = preg_replace('/[^0-9\.]/', '', $input['salary_min']);
        }

		if ($request->has('salary_max')) {
            $input['salary_max'] = str_replace(',', '.', $request->input('salary_max'));
			$input['salary_max'] = preg_replace('/[^0-9\.]/', '', $input['salary_max']);
		}

        if ($request->has('contact_phone')) {
            // Keep only numeric characters
            $input['contact_phone'] = preg_replace('/[^0-9]/', '', $request->input('contact_phone'));
        }
        
        if ($request->has('phone')) {
            // Keep only numeric characters
            $input['phone'] = preg_replace('/[^0-9]/', '', $request->input('phone'));
        }
        
        $request->replace($input);
    }
}
