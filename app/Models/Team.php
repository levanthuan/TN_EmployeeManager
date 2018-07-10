<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = "teams";

    public function division()
    {
    	return $this->belongsTo('App\Models\Division', 'divisions_id', 'id');
    }

    public function leader()
    {
    	return $this->belongsTo('App\Models\User', 'leader_id', 'id');
    }

    public function users()
    {
    	return $this->hasMany('App\Models\User', 'teams_id', 'id');
    }
}
