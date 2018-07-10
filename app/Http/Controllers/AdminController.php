<?php

namespace App\Http\Controllers;

use Cron\MonthField;
use Illuminate\Http\Request;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Controllers\Controller;
use App\Models\MemberMail;
use App\Models\Notification;
use App\Models\User;
use App\Models\Team;
use App\Models\Division;
use App\Models\UserNotification;
use Carbon\Carbon;
use Auth;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $listTimeOff = MemberMail::all()->sortByDesc("time_send")->take(5);
        $listNotification = Notification::all()->sortByDesc("id")->take(5);
        $listUserBirthday = DB::table('users')->whereMonth('birth_day', date("m"))->whereDay('birth_day', '>=', date("d"))
            ->orderBy(DB::raw("MONTH(birth_day)"), "asc")
            ->orderBy(DB::raw("DAY(birth_day)"), "asc")
            ->orderBy(DB::raw("YEAR(birth_day)"), "asc")
            ->take(5)->get();
        $count = count($listUserBirthday);
        $get = 0;
        if ($count < 5) {
            $listUserBirthday2 = DB::table('users')->whereMonth('birth_day', '>', date("m"))
                ->orderBy(DB::raw("MONTH(birth_day)"), "asc")
                ->orderBy(DB::raw("DAY(birth_day)"), "asc")
                ->orderBy(DB::raw("YEAR(birth_day)"), "asc")
                ->take(5 - $count)->get();
            $get = 1;
        }
        if ($get = 1) {
            if (($count + count($listUserBirthday2)) < 5) {
                $listUserBirthday3 = DB::table('users')
                    ->orderBy(DB::raw("MONTH(birth_day)"), "asc")
                    ->orderBy(DB::raw("DAY(birth_day)"), "asc")
                    ->orderBy(DB::raw("YEAR(birth_day)"), "asc")
                    ->take(5 - $count - count($listUserBirthday2))->get();
                $get = 2;
                return view('admin.content.index', [
                    'listTimeOff'           => $listTimeOff,
                    'listNotification'      => $listNotification,
                    'listUserBirthday'      => $listUserBirthday,
                    'listUserBirthday2'      => $listUserBirthday2,
                    'listUserBirthday3'      => $listUserBirthday3,
                ]);
            }
            return view('admin.content.index', [
                'listTimeOff'           => $listTimeOff,
                'listNotification'      => $listNotification,
                'listUserBirthday'      => $listUserBirthday,
                'listUserBirthday2'      => $listUserBirthday2,
                'listUserBirthday3'      => null,
            ]);
        }

        return view('admin.content.index', [
            'listTimeOff'           => $listTimeOff,
            'listNotification'      => $listNotification,
            'listUserBirthday'      => $listUserBirthday,
            'listUserBirthday2'      => null,
            'listUserBirthday3'      => null,
        ]);
    }

    public function getTimeOffRequests()
    {
        $timeOffs = MemberMail::orderBy('time_send', 'desc')->paginate(10);
        return view('admin.content.time_off_requests',['timeOffs' => $timeOffs]);
    }

    public function showTimeOffRequest($id)
    {
        $timeOffRequest = MemberMail::find($id);
        $timeOffRequest->admin_status = 'seen';
        $timeOffRequest->save();
        return view('admin.content.time_off_request', ['timeOffRequest' => $timeOffRequest]);
    }


    public function getProfile()
    {
        return view('admin.content.profile');
    }


    public function postSearch(Request $request)
    {
        $key = $request['key'];
        $users = User::where('name','like',"%$key%")
            ->orWhere('fullname','like',"%$key%")
            ->orWhere('birth_day','like',"%$key%")->take(30)->paginate(8);    
        $teams = Team::where('name','like', "%$key%")->take(30)->paginate(8);
        $divs = Division::where('name','like',"%$key%")
            ->take(30)->paginate(8);
        
        return view('admin.content.search', compact('users','teams', 'divs')); 
    }

    public function getSearch()
    {
        return view('admin.content.search', compact('users','teams')); 
    }

    public function getTeamInfo()
    {
        return view('admin.content.team_info');
    }

    public function getTeamDivisionInfo()
    {
        return view('admin.content.team_division');
    }

    public function getListBirthday()
    {
        $listBirthdays = DB::table('users')->whereMonth('birth_day', date("m"))->whereDay('birth_day','>=',date("d"))
            ->orderBy(DB::raw("MONTH(birth_day)"),"asc")
            ->orderBy(DB::raw("DAY(birth_day)"),"asc")
            ->orderBy(DB::raw("YEAR(birth_day)"),"asc")
            ->paginate(10);
        $count2 = count($listBirthdays);
        $listBirthdays2 = DB::table('users')->whereMonth('birth_day', '>', date("m"))
            ->orderBy(DB::raw("MONTH(birth_day)"), "asc")
            ->orderBy(DB::raw("DAY(birth_day)"), "asc")
            ->orderBy(DB::raw("YEAR(birth_day)"), "asc")
            ->paginate(10);
        if (count($listBirthdays2)== 0)
        {
            $listBirthdays2 = DB::table('users')->whereMonth('birth_day', '<', date("m"))
                ->orderBy(DB::raw("MONTH(birth_day)"), "asc")
                ->orderBy(DB::raw("DAY(birth_day)"), "asc")
                ->orderBy(DB::raw("YEAR(birth_day)"), "asc")
                ->paginate(10);
        }
        return view('admin.content.list_birthday',[
            'listBirthdays' => $listBirthdays,
            'listBirthdays2' => $listBirthdays2,
        ]);
    }

    public function putRemove(Request $request, $id)
    {
        User::findOrFail($id)->update([
            'teams_id' => 0
            ]);
        $user = User::find($id);
        $user->teams_id = 0;
        $user->teams_divisions_id = 0;
        $user->save();
        return redirect()->back();
    }

    public function searchAdd(Request $request)
    {
        $keyword = $request['keyword'];
        $team_id = $request['team_id'];
        $div_id = $request['div_id'];
        if ($request->ajax()){
            $users = User::where('fullname', 'like', "%$keyword%")
            ->where('teams_id', 0)
            ->where('level', '>', 2)
            ->orderBy('fullname')->paginate(6);
            $link = view('admin.content.search_add', compact('users', 'team_id', 'div_id'))->render();
            $result = [
                'success' => true,
                'keyword' => $keyword,
                'html' => $link
            ];

            return response()->json($result);
        }
    }

    public function addMember(Request $request, $id)
    {

        User::findOrFail($id)->update([
            'teams_id' => $request['team_id']
            ]);
        $teams_divisions = Team::findOrFail($request['team_id']);
        $user = User::find($id);
        $user->teams_divisions_id = ($teams_divisions->divisions_id) ?  $teams_divisions->divisions_id : null;
        $user->save();
        return redirect()->back();
    }
}
