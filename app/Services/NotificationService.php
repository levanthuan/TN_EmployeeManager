<?php

namespace App\Services;

use Auth;
use App\Models\Notification;
use App\Models\UserNotification;
use App\Models\MemberMail;
use App\Models\User;

class NotificationService
{
    
    public function getListUnseenNotification()
    {
        $user = Auth::user();
        $userNotifications = UserNotification::orderBy('id', 'desc')
        									->where('users_id', $user->id)
        									->where('status', 'unseen')->get();
        return $userNotifications;
    }

    public function getListTimeOffRequest()
    {
    	$user = Auth::user();
        if ($user->level == 1 || $user->level == 2) {
            $timeOffRequests = MemberMail::orderBy('id', 'desc')
                                            ->where('admin_status', 'unseen')
                                            ->whereNotIn('status', ['done'])
                                            ->whereNotIn('users_id', [$user->id])
                                            ->get();
        }
    	if ($user->level == 3) {
    		$timeOffRequests = MemberMail::orderBy('id', 'desc')
    								        ->whereNotIn('status', ['done', 'div_done'])
                                            ->whereNotIn('users_id', [$user->id])
    								        ->get();
            $count = 0;
            foreach ($timeOffRequests as $timeOffRequest) {
                if ($timeOffRequest->user->teams_divisions_id != $user->teams_divisions_id) {
                    unset($timeOffRequests[$count]);
                }
                $count++;
            }                                
    	}
        if ($user->level == 4) {
            $timeOffRequests = MemberMail::orderBy('id', 'desc')
                                            ->whereNotIn('status', ['done', 'team_done'])
                                            ->whereNotIn('users_id', [$user->id])
                                            ->get();
            $count = 0;                                
            foreach ($timeOffRequests as $timeOffRequest) {
                if ($timeOffRequest->user->teams_id != $user->teams_id) {
                    unset($timeOffRequests[$count]);
                }
                $count++;
            }
        }
    	return $timeOffRequests;
    }

    public function countNotifications()
    {
    	$count = 0;
    	$userLevel = Auth::user()->level;
    	switch ($userLevel) {
    		case '1':
    			$count = count($this->getListTimeOffRequest());
    			break;
    		case '2':
    			$count = count($this->getListTimeOffRequest());
    			break;
    		case '3':
    			$count = count($this->getListUnseenNotification());
    			$count += count($this->getListTimeOffRequest());
    			break;
    		case '4':
    			$count = count($this->getListUnseenNotification());
    			$count += count($this->getListTimeOffRequest());
    			break;
    		case '5':
    			$count = count($this->getListUnseenNotification());
    			break;			
    	}
    	return $count;
    }

}