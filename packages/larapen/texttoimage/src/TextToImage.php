<?php
/*
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

namespace Larapen\TextToImage;

use Larapen\TextToImage\Libraries\Settings;
use Larapen\TextToImage\Libraries\TextToImageEngine;

class TextToImage
{
    /**
     * @param       $string
     * @param       $format
     *
     * @param array $overrides
     * @param bool $encoded
     *
     * @return string
     */
    public function make($string, $format = IMAGETYPE_JPEG, $overrides = array(), $encoded = true)
    {
        if (trim($string) == '') {
            return $string;
        }

        $settings = Settings::createFromIni(__DIR__ . DIRECTORY_SEPARATOR . 'settings.ini');
        $settings->format = $format;
        $settings->fontFamily = __DIR__ . '/Libraries/' . $settings->fontFamily;
        $settings->assignProperties($overrides);
        
        $image = new TextToImageEngine($settings);
        $image->setText($string);
        
        if ($encoded) {
            return $image->getEmbeddedImage();
        }
        
        return $image;
    }
}
