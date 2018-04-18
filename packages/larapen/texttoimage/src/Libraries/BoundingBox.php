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

namespace Larapen\TextToImage\Libraries;

class BoundingBox
{
    public $width;
    public $height;
    public $padding;
    
    public function __construct($width, $height, $padding)
    {
        $this->width = $width;
        $this->height = $height;
        $this->padding = $padding;
    }
}
