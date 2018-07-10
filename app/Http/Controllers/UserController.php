<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\Division;
use App\Models\Team;
use App\Models\User;
use Hash;
use Auth;
use DB;
class UserController extends Controller
{
    public function index()
    {
        $listTeam = Team::all();
        $user = Auth::user();
        $listNotification = UserNotification::where('users_id', $user->id)->orderBy("id", "Desc")->take(10)->get();
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
                return view('user.content.index', [
                    'listTeam' => $listTeam,
                    'listNotification' => $listNotification,
                    'listUserBirthday' => $listUserBirthday,
                    'listUserBirthday2' => $listUserBirthday2,
                    'listUserBirthday3' => $listUserBirthday3,
                ]);
            }
            return view('user.content.index', [
                'listTeam' => $listTeam,
                'listNotification' => $listNotification,
                'listUserBirthday' => $listUserBirthday,
                'listUserBirthday2' => $listUserBirthday2,
                'listUserBirthday3' => null,
            ]);
        }
    }

    public function getTeamInfo() 
    {
        return view('user.content.team_info');
    }

    public function getListUser($limit)
    {
        if ($limit == 'all') {
            $listUser = User::all();
        } else {
            $listUser = User::paginate($limit);
        }
        if (Auth::user()->level <= 2) {
            return view('admin.content.list_user', ['listUser' => $listUser, 'limit' => $limit]);
        }
        return view('user.content.list_user', ['listUser' => $listUser, 'limit' => $limit]);        
    }

    public function getSalary()
    {
    	return view('user.content.salary');
    }    

    public function getArrayTeam()
    {
        return view('user.content.array_team');
    }

    public function getNewUser()
    {
        $listTeam = Team::all();
        
        return view('admin.content.new_user' , ['listTeam' => $listTeam]);
    }

    public function postNewUser(CreateUserRequest $request)
    {
        
        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->teams_id = 0;
        $user->day_into = $request->day_into;
        $user->level = $request->position;
        $user->fullname = $request->fullname;
        $user->teams_divisions_id = 0;
        $user->avatar = 'icon_user.png';
        $user->save();

        return redirect()->route('new_user')->with('notification', 'Create a new user successfully.');
    }

    public function postSearch(Request $request)
    {
        $key = $request['key'];
        $users = User::where('fullname','like',"%$key%")
            ->orWhere('name','like',"%$key%")->take(30)->paginate(8);        
        $teams = Team::where('name','like', "%$key%")->take(30)->paginate(8);        
        $divs = Division::where('name','like',"%$key%")
            ->take(30)->paginate(8); 
        
        return view('user.content.user_search', compact('users','teams', 'divs'));
    }

    public function putRemove(Request $request, $id)
    {
        User::findOrFail($id)->update([
            'teams_id' => 0,
            'teams_divisions_id' => 0
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
            $link = view('user.content.search_add', compact('users', 'team_id', 'div_id'))->render();
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
            'teams_id' => $request['team_id'],
            'teams_divisions_id' => $request['div_id']
            ]);
        $user = User::find($id);
        $user->teams_id = Auth::user()->team->id;
        $user->teams_divisions_id = Auth::user()->team->division->id;
        $user->save();
        return redirect()->back();
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
        return view('user.content.list_birth_day',[
            'listBirthdays' => $listBirthdays,
            'listBirthdays2' => $listBirthdays2,
        ]);
    }


    public function getDeleteUser($id)
    {
        $user = User::find($id);
        if ($user->level != 1 && $user->level != 2) {
            if ($user->level == 3) {
                $division = Division::find($user->division->id);
                $division->leader_id = 0;
                $division->save();
            }
            if ($user->level == 4) {
                $team = Team::find($user->team->id);
                $team->leader_id = 0;
                $team->save();
            }
            if ($user->avatar != null && $user->avatar != 'icon_user.png') {
                File::delete('image/'.$user->avatar);
            }
            $user->delete();
            return redirect()->route('admin_list_user')->with('success', 'Delete account successfully.');
        }
        return redirect()->route('admin_list_user')->with('warning', 'This account can not be deleted.');
    }
    public function getListReviewSalary()
    {
        $listUser = User::whereNotIn('level', ['1', '2'])->get();
        return view('admin.content.list_review_salary', ['listUser' => $listUser]);
    }
}
