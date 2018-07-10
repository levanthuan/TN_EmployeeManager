<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'divisions';

    public function teams()
    {
    	return $this->hasMany('App\Models\Team', 'divisions_id', 'id');
    }

    public function leader()
    {
    	return $this->belongsTo('App\Models\User', 'leader_id', 'id');
    }

    public function members()
    {
    	return $this->hasMany('App\Models\User', 'teams_divisions_id', 'id');
    }
}
