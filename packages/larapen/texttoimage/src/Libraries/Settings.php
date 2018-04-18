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

class Settings
{
    public $color = '#000000';
    public $backgroundColor = '#FFFFFF';
    public $fontFamily = null;
    public $fontSize = 12;
    public $padding = 5;
    public $quality = 90;
    public $format = IMAGETYPE_JPEG;
    public $blur = 0;
    public $pixelate = 0;
    
    public static function createFromIni($iniFile)
    {
        $settings = new Settings();
        
        // cannot find settings file
        if (!realpath($iniFile)) {
            return $settings;
        }
        
        // parse config file
        $properties = @parse_ini_file($iniFile);
        if (empty($properties)) {
            return $settings;
        }
        
        $settings->assignProperties($properties);
        
        return $settings;
    }
    
    public function assignProperties($properties)
    {
        if (empty($properties) || !is_array($properties)) {
            return;
        }
        
        foreach ($properties as $name => $value) {
            if (!property_exists($this, $name)) {
                continue;
            }
            
            $this->$name = $value;
        }
    }
}
