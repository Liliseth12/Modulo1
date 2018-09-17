<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Employee;

class Dailyreport extends Model
{
    //
    protected $table = 'dailyreports';

    protected $fillable = [
    'id',
    'employee_ci',
    'name',
    'date',
    'arrival_time',
    'departure_time',
    'delay',
    'early',
    'extrahour',
    'deduction',
    'assignment',
    'justification'];

    public function employee(){
    	return $this->belongsTo('App\Employee');
    }
}
