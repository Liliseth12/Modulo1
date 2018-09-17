<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Employee;
use \App\Project;

class Department extends Model
{
    //
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $table = 'departments';

    protected $fillable = [
    'id',
    'department_name'
    ];

    public function employees(){
    	return $this->hasMany('App\Employee')->withTrashed();
    }

    public function projects(){
    	return $this->hasMany('App\Project')->withTrashed();
    }
}
