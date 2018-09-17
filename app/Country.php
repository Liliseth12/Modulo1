<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Employee;
use \App\Brand;

class Country extends Model
{
    //
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $table = 'countries';

    protected $fillable =[
    'id',
    'name'
    ];

    public function employees(){
    	return $this->hasMany('App\Employee');
    }

    public function brands(){
    	return $this->hasMany('App\Brand');
    }
}
