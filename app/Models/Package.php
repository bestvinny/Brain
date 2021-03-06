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

use App\Models\Scopes\ActiveScope;
use App\Models\Traits\Translated;

class Package extends BaseModel
{
    use Translated;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'packages';
    
    /**
     * The primary key for the model.
     *
     * @var string
     */
    // protected $primaryKey = 'id';
    protected $appends = ['tid'];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'short_name',
        'ribbon',
        'has_badge',
        'price',
        'currency_code',
        'duration',
        'description',
        'active',
        'parent_id',
        'lft',
        'rgt',
        'depth',
        'translation_lang',
        'translation_of'
    ];
    public $translatable = ['name', 'short_name', 'description'];
    
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
    // protected $dates = [];
    
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope(new ActiveScope());

        // before delete() method call this
        static::deleting(function ($package) {
            // Delete all translated entries
            $package->translated()->delete();

            // Delete all payment entries in database
            $payments = Payment::where('package_id', $package->id)->get();
            if (!empty($payments)) {
                foreach ($payments as $payment) {
                    $payment->delete();
                }
            }
        });
    }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_code', 'code');
    }
    
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_code', 'code');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment', 'package_id');
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
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
