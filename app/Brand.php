<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Country;
use \App\Project;

class Brand extends Model
{
    //
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'brands';

    protected $fillable = [
    'id',
    'name',
    'country_id'
    ];

    public function country(){
    	return $this->belongsTo('App\Country')->withTrashed();
    }

    public function projects(){
    	return $this->hasMany('App\Project')->withTrashed();
    }
}
