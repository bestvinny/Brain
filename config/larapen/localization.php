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
    | Default URIs
    |--------------------------------------------------------------------------
    |
    | 'default_uri' => Homepage
    | 'countries_list_uri' => Page that show the countries list
    */
    
    'default_uri' => '/',
    'countries_list_uri' => 'countries',
    
    
    /*
    |--------------------------------------------------------------------------
    | Cache and Cookies Expiration
    |--------------------------------------------------------------------------
    | Value in seconds
    |
    | InMinute = 60; InHour = 3600; InDay = 86400; InWeek = 604800; InMonth = 2592000;
    */
    
    'cache_expire' => 3600,
    'cookie_expire' => 2592000,
    
    
    /*
    |--------------------------------------------------------------------------
    | Default Country
    |--------------------------------------------------------------------------
    |
    | Use the countries ISO Code
    | E.g. Use 'BJ' for Benin.
    | Let this value empty to allow user to select a country if her IP not found or if her IP belong a banned country.
    */
    
    'default_country' => '',
    'show_country_flag' => true,

];
