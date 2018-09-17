<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Salary;
use \App\Position;
use \App\Country;
use \App\Department;
use \App\Dailyreport;
use \App\User;

class Employee extends Model
{
    //
	protected $table = 'employees';

	protected $fillable = [
    'id',
	'firstname', 
	'lastname', 
	'email', 
	'ci',
    'country_id',
    'department_id', 
	'phonenumber',
	'entrydate', 
	'outdate'];

    public function salaries(){
    	return $this->belongsToMany('App\Salary')
    				->withPivot('date')
    				->withTimestamps();
    }

    public function positions(){
    	return $this->belongsToMany('App\Position')
    				->withPivot('date')
    				->withTimestamps()->withTrashed();
    }

    public function country(){
        return $this->belongsTo('App\Country')->withTrashed();
    }
    
    public function department(){
        return $this->belongsTo('App\Department')->withTrashed();
    }

    public function dailyreports(){
        return $this->hasMany('App\Dailyreport');
    }

}
