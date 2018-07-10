<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'users_id', 'id');
    }

    public function profile()
    {
    	return $this->belongsTo('App\Models\Profile', 'profiles_id', 'id');
    }
}
