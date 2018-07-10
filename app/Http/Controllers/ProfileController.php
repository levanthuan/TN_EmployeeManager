<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TimeOffRequest;
use App\Http\Requests\CreateFieldRequest;
use App\Models\MemberMail;
use Carbon\Carbon;
use Auth;
use App\Models\User;
use Hash;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\AdminUpdateProfileRequest;
use App\Models\Profile;
use App\Models\UserProfile;
use File;
use Mail;

class ProfileController extends Controller
{
    public function getTimeSheet()
    {
    	return view('user.content.time_sheet');
    }

    public function getCreateTimeOffRequest()
    {
        $userId = Auth::user()->id;
        $listTimeOffRequest = MemberMail::where('users_id', $userId)
                                        ->orderBy('id', 'desc')
                                        ->take(5)
                                        ->get();
    	return view('user.content.time_off', ['listTimeOffRequest' => $listTimeOffRequest]);
    }

    public function postCreateTimeOffRequest(TimeOffRequest $request)
    {
        $time_send = Carbon::now('Asia/Ho_Chi_Minh');
        $timeOffRequest = new MemberMail;
        $timeOffRequest->content = 'Time-off request';
        $timeOffRequest->time_start = $request->start_time;
        $timeOffRequest->time_end = $request->end_time;
        $timeOffRequest->admin_status = 'unseen';
        $timeOffRequest->status = 'none';
        $timeOffRequest->reason = $request->reason;
        $timeOffRequest->time_send = $time_send;
        $timeOffRequest->users_id = Auth::user()->id;
        $timeOffRequest->save();
        if ($request->ck_send_email == 'on') {
            $mailSender = Auth::user();
            $idLeaderTeam = null;
            $idLeaderDivision = null;
            $teamDivision = null;
            if ($mailSender->teams_id != null && $mailSender->team->leader_id != null) {
                $idLeaderTeam = $mailSender->team->leader->id;
            }
            if ($mailSender->teams_divisions_id != null && $mailSender->division->leader_id != null) {
                $idLeaderDivision = $mailSender->division->leader->id;
            }
            
            $listRecipientMail = User::where('id', $idLeaderTeam)
                                     ->orWhere('id', $idLeaderDivision)
                                     ->orWhere('level', '=', 2)->get();
            $name = $mailSender->fullname;
            if ($mailSender->teams_divisions_id != null) {
                $teamDivision = $mailSender->division->name;
            }
            $timeStart = $request->start_time;
            $timeEnd = $request->end_time;
            $reason = $request->reason;
            $data = ['timeStart' => $timeStart, 'timeEnd' => $timeEnd, 'reason' => $reason, 
                                                            'name' => $name, 'teamDivision' => $teamDivision];
            Mail::send('user.content.time_off_request_mail', $data, function($msg) use($listRecipientMail, $mailSender){
                $msg->from($mailSender->email, $mailSender->fullname);
                foreach ($listRecipientMail as $user) {
                    $msg->to( $user->email , '')->subject('Time Off Request');
                }
            });
        }
        return redirect()->route('user_time_off_request')
                         ->with('notification', 'Create time off request successfully!');
    }    


    public function postEditUser ($id, UpdateProfileRequest $request)
    {
        $user = User::find($id);
        $profiles = Profile::all();
        $userProfiles = UserProfile::where('users_id', $id)->get();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->birth_day = $request->birth_day;
        $user->gender = $request->gender;
        $user->address = $request->address;
        
        if (count($profiles) > 0) {
            $i = 0;
            foreach ($profiles as $profile) {
                $userProfile = UserProfile::where('users_id', $id)
                                            ->where('profiles_id', $profile->id)->first();
                if (empty($userProfile)) {
                    $newUserProfile = new UserProfile;
                    $newUserProfile->users_id = $id;
                    $newUserProfile->profiles_id = $profile->id;
                    $newUserProfile->value = $request->element[$i];
                    $newUserProfile->save();
                } else {
                    $userProfile->value = $request->element[$i];
                    $userProfile->save();
                }
                $i++;
            }
        }
        $user->save();

        return redirect()->back()->with('notification', 'Edit myprofile successfully.');
    }
    
    public function postChangeAvatar(Request $request, $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return redirect()->back()->with('error', 'Account does not exist.');
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $tailFile = $file->getClientOriginalExtension();
            if ($tailFile != 'jpg' && $tailFile != 'png' && $tailFile != 'jpeg') {
                return redirect()->back()->with('error', 'You can only add images with image tail in jpg, png, jpeg');
            }
            $nameFile = $file->getClientOriginalName();
            $newNameFile = str_random(4)."_".$nameFile;
            while (file_exists("image/".$newNameFile)) {
                $newNameFile = str_random(4)."_".$nameFile;
            }            
            if ($user->avatar != null && $user->avatar != 'icon_user.png') {
                File::delete('image/'.$user->avatar);
            }
            $file->move('image', $newNameFile);
            $user->avatar = $newNameFile;
            $user->save();
            return redirect()->back()->with('notification', 'Change avatar successfully.');
        }
        return redirect()->back()->with('warning', 'You have not selected an image.');
    }

    public function showTimeOffRequest($id)
    {
        $timeOffRequest = MemberMail::find($id);
        return view('user.content.show_time_off_request', ['timeOffRequest' => $timeOffRequest]);
    }
    
    public function approveTimeOffRequest($id)
    {
        $userLevel = Auth::user()->level;
        $timeOffRequest = MemberMail::find($id);
        if ($userLevel == 3) {
            if ($timeOffRequest->status == 'team_done') {
                $timeOffRequest->status = 'done';
            } else {
                $timeOffRequest->status = 'div_done';
            }
        } else {
            if ($timeOffRequest->status == 'div_done') {
                $timeOffRequest->status = 'done';
            } else {
                $timeOffRequest->status = 'team_done';
            }
        }
        $timeOffRequest->save();

        return redirect()->route('show_time_off_request', ['timeOffRequest' => $timeOffRequest])
                         ->with('notification', 'Approve time off request successfully !');
    }

    public function index($id)
    {        
        $user = User::find($id);
        $profiles = Profile::all();
        $userProfiles = UserProfile::where('users_id', $id)->get();
        if (Auth::user()->level <= 2) {
            return view('admin.content.profile', ['user' => $user, 
                    'userProfiles' => $userProfiles, 'profiles' => $profiles]);
        }
    	return view('user.content.profile', ['user' => $user, 'userProfiles' => $userProfiles, 'profiles' => $profiles]);
    }

    public function updatePass() {        
        return view('user.content.update_pass');
    }

    public function postChangePass (ChangePassRequest $request)
    {
        $user = Auth::user();
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->NewPassRepeat);
            $user->save();
            return redirect()->back()->with('notification', 'Change password user successfully.');
        }
        return redirect()->back()->with('error', 'Current password invalid.');
    }

    public function getAddNewField()
    {
        $profiles = Profile::all();
        $listField = array('id', 'name', 'fullname', 'email', 'password', 'level', 'birth_day', 
                            'gender', 'avatar', 'address', 'phone_number', 'day_into', 'salary');
        return view('admin.content.add_new_field', ['listField' => $listField, 'profiles' => $profiles]);
    }

    public function postAddNewField(CreateFieldRequest $request)
    {
        $arrayField = array('id', 'name', 'username', 'User', 'Username','email', 'Email', 
            'password', 'Password', 'level', 'Level', 'fullname', 'Fullname', 'birth_day', 'Birth_Day', 
            'gender', 'Gender', 'avatar', 'address', 'phone_number', 'day_into', 'salary', 'teams_id', 
            'teams_divisions_id');
        if (in_array($request->name, $arrayField) == 1) {
            return redirect()->route('add_new_field')
                             ->with('warning', 'This information field already exists.');
        }
        $profile = new Profile;
        $profile->description = $request->name;
        $profile->type = $request->type;
        $profile->save();
        return redirect()->route('add_new_field')
                         ->with('notification', 'Add new field user information successfully !');
    }

    public function getDeleteField($id)
    {
        $profile = Profile::find($id);
        if (empty($profile)) {
            return redirect()->route('add_new_field')->with('error', 'This field imformation not exist.');
        }
        $profile->delete();
        $userProfiles = UserProfile::where('profiles_id', $id)->get();
        foreach ($userProfiles as $userProfile) {
            $userProfile->delete();
        }
        return redirect()->route('add_new_field')->with('notification', 'Delete field successfully.');
    }

    public function postUpdateProfile($id, AdminUpdateProfileRequest $request)
    {
        $user = User::find($id);
        if (empty($user)) {
            return redirect()->back()->with('warning', 'This account does not exist. This account can not update');
        }
        $profiles = Profile::all();
        $userProfiles = UserProfile::where('users_id', $id)->get();

        $user->name = $request->username;
        $user->email = $request->email;
        $user->fullname = $request->fullname;
        $user->birth_day = $request->birth_day;
        $user->gender = $request->gender;
        $user->address = $request->address;
        if ($request->phone_number != null) {
            $rules = [
                'phone_number'      => 'digits_between:9,12',
            ];
            $messages = [
                'new_password.required'     => 'The phone number must be between 9 and 12 digits.',
            ];
            $this->validate($request, $rules, $messages);
            $user->phone_number = $request->phone_number;
        }
        $user->day_into = $request->day_into;
        if ($user->level > 2) {
            $user->level = $request->position;
        }        

        if ($request->cb_change_pass == 'on') {
            $rules = [
                'new_password' => 'required|min:3|max:32',
                're_password'  => 'required|same:new_password'
            ];
            $messages = [
                'new_password.required'     => 'Please enter new password',
                'new_password.max'          => 'Password too long',
                'new_password.min'          => 'Password too short.',
                're_password.required'      => 'You have not entered a re-enter password',
                're_password.same'          => 'The new password and re-enter password do not match',
            ];
            $this->validate($request, $rules, $messages);
            $user->password = Hash::make($request->re_password);
        }
        if (count($profiles) > 0) {
            $i = 0;
            foreach ($profiles as $profile) {
                $userProfile = UserProfile::where('users_id', $id)
                                            ->where('profiles_id', $profile->id)->first();
                if ($userProfile == null) {
                    $newUserProfile = new UserProfile;
                    $newUserProfile->users_id = $id;
                    $newUserProfile->profiles_id = $profile->id;
                    $newUserProfile->value = $request->element[$i];
                    $newUserProfile->save();
                } else {
                    $userProfile->value = $request->element[$i];
                    $userProfile->save();
                }
                $i++;
            }
        }

        $user->save();
        return redirect()->route('profile', ['user' => $user, 'userProfiles' => $userProfiles, 'profiles' => $profiles])
                         ->with('notification', 'Update profile successfully.');
    }
}
