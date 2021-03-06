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

namespace App\Models;

use App\Helpers\Geo;
use App\Models\Scopes\ActiveScope;

class City extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';
    
    /**
     * The primary key for the model.
     *
     * @var string
     */
    // protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    // protected $guarded = ['id'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'country_code',
        'name',
        'asciiname',
        'latitude',
        'longitude',
        'subadmin1_code',
        'subadmin2_code',
        'population',
        'time_zone',
        'active'
    ];
    
    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    // protected $hidden = [];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
    
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope(new ActiveScope());
    }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function ads()
    {
        return $this->hasMany('App\Models\Ad', 'city_id');
    }
    
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }
    
    public function timeZone()
    {
        return $this->hasOne('App\Models\TimeZone', 'country_code', 'country_code');
    }
    
    // Specials
    public function subAdmin2()
    {
        return SubAdmin2::where('code', $this->country_code . '.' . $this->subadmin1_code . '.' . $this->subadmin2_code)->first();
    }
    
    public function subAdmin1()
    {
        return SubAdmin1::where('code', $this->country_code . '.' . $this->subadmin1_code)->first();
    }
    
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    
    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getAsciinameAttribute($value)
    {
        return preg_replace(array('#\s\s+#', '#\' #'), array(' ', "'"), $value);
    }
    
    public function getNameAttribute($value)
    {
        //return Geo::getShortName($value);
        return $value;
    }
    
    public function getLatitudeAttribute($value)
    {
        return fixFloatVar($value);
    }
    
    public function getLongitudeAttribute($value)
    {
        return fixFloatVar($value);
    }
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
