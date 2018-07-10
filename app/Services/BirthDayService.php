<?php

namespace App\Services;

use Auth;
use App\Models\User;
use Carbon\Carbon;

class BirthDayService
{

    public function getMonth($user)
    {
        if ($user->birth_day != '') {
            $bits = explode('-', $user->birth_day);
            return $bits[1];
        }
        return null;
    }

    public function compareThisMonth($user, $number)
    {
        $date = new Carbon;
        $today = $date->format('d-m-Y');
        $bits = explode('-', $today);
        $month = $bits[1];
        if ($month + $number > 12) {
            $month = $month + $number - 12;
        } else {
            $month = $month + $number;
        }
        if ($this->getMonth($user) == $month) {
            return true;
        }
        return false;
    }

    public function getThisMonth($number)
    {
        $date = new Carbon;
        $today = $date->format('d-m-Y');
        $bits = explode('-', $today);
        $month = $bits[1];
        if ($month + $number > 12) {
            $month = $month + $number - 12;
        } else {
            $month = $month + $number;
        }
        switch ($month) {
            case '1': return 'January';
            case '2': return 'February';
            case '3': return 'March';
            case '4': return 'April';
            case '5': return 'May';
            case '6': return 'June';
            case '7': return 'July';
            case '8': return 'August';
            case '9': return 'September';
            case '10': return 'October';
            case '11': return 'November';
            case '12': return 'December';
        }
    }
}