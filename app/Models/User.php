<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'level','fullname','birth_day','gender','avatar','address','phonenumber', 'day_into','saraly','teams_id', 'teams_division_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'teams_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division', 'teams_divisions_id', 'id');
    }
}
