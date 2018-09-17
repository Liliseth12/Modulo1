<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Project;

class Customer extends Model
{
    //
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'customers';

    protected $fillable = [
    'id',
    'name',
    'email',
    'is_coor'
    ];

    public function projects(){
    	return $this->hasMany('App\Project');
    }
}
