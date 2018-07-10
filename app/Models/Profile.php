<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    public function user_profiles()
    {
    	return $this->hasMany('App\Models\UserProfile', 'profiles_id', 'id');
    }
}
