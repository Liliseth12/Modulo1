<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Employee;

class Position extends Model
{
    //
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
	protected $table = 'positions';

	protected $fillable = [
    'id',
	'position_name',
    'active'
	];

     public function employees()
    {
        return $this->belongsToMany('App\Employee')
        			->withPivot('date')
        			->withTimestamps();
    }
}
