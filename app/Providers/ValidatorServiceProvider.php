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

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['validator']->extend('whitelist_domain', function ($attribute, $value) {
            return Validator::checkDomain($value);
        });
        
        $this->app['validator']->extend('whitelist_email', function ($attribute, $value) {
            return Validator::checkEmail($value);
        });
        
        $this->app['validator']->extend('whitelist_word', function ($attribute, $value) {
            return Validator::checkWord($value);
        });
        
        $this->app['validator']->extend('whitelist_word_title', function ($attribute, $value) {
            return Validator::checkTitle($value);
        });
        
        $this->app['validator']->extend('mb_between', function ($attribute, $value, $parameters, $validator) {
            return Validator::mbBetween($value, $parameters);
        });
    }
    
    public function register()
    {
        //
    }
}
