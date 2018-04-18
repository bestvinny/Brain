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

return [

    /*
     |--------------------------------------------------------------------------
     | Default Logo
     |--------------------------------------------------------------------------
     |
     */

    'logo' => 'app/default/logo.png',

    /*
     |--------------------------------------------------------------------------
     | Default Favicon
     |--------------------------------------------------------------------------
     |
     */

    'favicon' => 'app/default/ico/favicon.png',

    /*
     |--------------------------------------------------------------------------
     | Default ads picture & Default ads pictures sizes
     |--------------------------------------------------------------------------
     |
     */

    'picture' => [
        'default' => 'app/default/picture.png',
        'size' => [
            'width'  => 1000,
            'height' => 1000,
        ],
        'quality' => 100,
        'resize' => [
            'small'     => '120x90',
            'medium'    => '320x240',
            'big'       => '816x460',
            'large'     => '1000x1000'
        ],
    ],
    
    /*
     |--------------------------------------------------------------------------
     | Default user profile picture
     |--------------------------------------------------------------------------
     |
     */
    
    'photo' => '',

    /*
     |--------------------------------------------------------------------------
     | Set as default language the browser language
     |--------------------------------------------------------------------------
     |
     */

    'detect_browser_language' => false,

    /*
     |--------------------------------------------------------------------------
     | Optimize your links for SEO (for International website)
     |--------------------------------------------------------------------------
     |
     */

    'multi_countries_website' => false,

	/*
     |--------------------------------------------------------------------------
     | Force links to use the HTTPS protocol
     |--------------------------------------------------------------------------
     |
     */

	'force_https' => true,

    /*
     |--------------------------------------------------------------------------
     | Plugins Path & Namespace
     |--------------------------------------------------------------------------
     |
     */

    'plugin' => [
        'path'      => app_path('Plugins') . '/',
        'namespace' => '\\App\Plugins\\',
    ],

];
