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
 * 	created	: 31 August, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
 */


namespace App\Http\Requests\Admin;

class AdRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'         => 'required|not_in:0',
            'ad_type_id'          => 'required|not_in:0',
            'company_name'        => 'required|mb_between:10,200|whitelist_word_title',
            'company_description' => 'required|mb_between:10,3000|whitelist_word',
            'title'               => 'required|between:5,200',
            'description'         => 'required|between:5,3000',
            'contact_name'        => 'required|between:3,200',
            'contact_email'       => 'required|email|max:100',
        ];
    }
}
