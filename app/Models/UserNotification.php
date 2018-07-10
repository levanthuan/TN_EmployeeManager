<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserNotification extends Model
{
    protected $table = "user_notifications";

    public function notification()
    {
    	return $this->belongsTo('App\Models\Notification', 'notifications_id', 'id');
    }

    public function status()
    {
    	return $this->belongsTo('App\Models\Notification', 'notifications_id', 'id');
    }


}
