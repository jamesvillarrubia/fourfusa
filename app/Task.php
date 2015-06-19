<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Task extends Model {

    protected $fillable = ['title', 'isDone'];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function labels()
    {
    	return $this->belongsToMany('App\Label');
    }
    
}
