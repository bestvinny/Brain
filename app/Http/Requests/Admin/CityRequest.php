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

class CityRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_code'   => 'required|min:2|max:2',
            'name'           => 'required|min:2|max:255',
            'asciiname'      => 'required|min:2|max:255',
            'latitude'       => 'required',
            'longitude'      => 'required',
            'subadmin1_code' => 'required',
            'time_zone'      => 'required',
        ];
    }
}
