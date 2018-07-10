<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberMail extends Model
{
    protected $table = "member_mails";

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'users_id', 'id');
    }
}
