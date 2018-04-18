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

namespace Larapen\LaravelMetaTags;

use Torann\LaravelMetaTags\MetaTagsServiceProvider as TorannMetaTagsServiceProvider;

class MetaTagsServiceProvider extends TorannMetaTagsServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['metatag'] = $this->app->share(function ($app) {
            return new MetaTag($app['request'], $app['config']['meta-tags'], $app['config']->get('app.locale'));
        });
    }
}
