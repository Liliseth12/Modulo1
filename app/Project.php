<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Department;
use \App\Customer;
use \App\Brand;

class Project extends Model
{
    //
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'projects';

    protected $fillable = [
    'id',
    'title',
    'duration',
    'start_date',
    'brand_id',
    'customer_id',
    'department_id'
    ];

    public function brand(){
    	return $this->belongsTo('App\Brand')->withTrashed();
    }

    public function customer(){
    	return $this->belongsTo('App\Customer');
    }

    public function department(){
    	return $this->belongsTo('App\Department');
    }
    
}
