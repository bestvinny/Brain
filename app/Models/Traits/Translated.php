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

namespace App\Models\Traits;

use Illuminate\Support\Facades\Request;

trait Translated
{
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function transById($id, $locale = '')
    {
        if (empty($locale) || $locale == '') {
            $locale = config('app.locale');
        }

        $entry = static::where('translation_of', $id)->where('translation_lang', $locale)->first();

        if (empty($entry)) {
            $entry = static::find($id);
        }

        return $entry;
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function translated()
    {
        return $this->hasMany(get_called_class(), 'translation_of');
    }
    

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getTranslationOfAttribute()
    {
        $translationOf = (isset($this->attributes['translation_of'])) ? $this->attributes['translation_of'] : null;
        $entityId = (isset($this->attributes['id'])) ? $this->attributes['id'] : $translationOf;

        // Admin panel
        if (Request::segment(1) == config('larapen.admin.route_prefix', 'admin')) {
            //return $translationOf;
        }

        // FrontOffice
        if (!empty($translationOf)) {
            if ($this->attributes['translation_lang'] == config('applang.abbr')) {
                return $entityId;
            } else {
                return $translationOf;
            }
        } else {
            return $entityId;
        }
    }

    public function getTidAttribute()
    {
        $translationOf = (isset($this->attributes['translation_of'])) ? $this->attributes['translation_of'] : null;
        $entityId = (isset($this->attributes['id'])) ? $this->attributes['id'] : $translationOf;

        // Admin panel
        if (Request::segment(1) == config('larapen.admin.route_prefix', 'admin')) {
            //return $translationOf;
        }

        // FrontOffice
        if (!empty($translationOf)) {
            if ($this->attributes['translation_lang'] == config('applang.abbr')) {
                return $entityId;
            } else {
                return $translationOf;
            }
        } else {
            return $entityId;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setTranslationOfAttribute($value)
    {
        $entityId = (isset($this->attributes['id'])) ? $this->attributes['id'] : null;

        if (empty($value)) {
            if ($this->attributes['translation_lang'] == config('applang.abbr')) {
                $this->attributes['translation_of'] = $entityId;
            } else {
                $this->attributes['translation_of'] = $value;
            }
        } else {
            $this->attributes['translation_of'] = $value;
        }
    }
}