<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Employee;

class Salary extends Model
{
    //
	protected $table = 'salaries';

    protected $fillable = [
    'id',
    'amount'];

    public function employees(){
    	return $this->belongsToMany('\App\Employee')
    				->withPivot('date')
    				->withTimestamps();
    }
}
