<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Auth;
use App\Http\Requests\CreateTeamRequest;
use App\Models\Division;
use App\Models\User;
use View;
use File;

class TeamController extends Controller
{
    public function getListTeam() 
    {
    	$listTeam = Team::paginate(5);
        if (Auth::user()->level <= 2 ) {
            return view('admin.content.list_team', ['listTeam' => $listTeam]);
        }
    	return view('user.content.list_team', ['listTeam' => $listTeam]);
    }
    
    public function getTeamInfo($id)
    {
        $team = Team::find($id);
        $listUser = User::where('teams_id', $id)->get();
        $listDivision = Division::all();
        if (Auth::user()->level <= 2) {
            return view('admin.content.team_info', ['team' => $team, 
                                                    'listUser' => $listUser, 
                                                    'listDivision' => $listDivision]);
        }
        return view('user.content.team_info', ['team' => $team]);
        
    }

    public function getNewTeam()
    {
        $listDivision = Division::all();
        $listTeam = Team::all();
        $listUser = User::where('level', 4)->get();
        return view('admin.content.new_team' , [
                'listDivision' => $listDivision,
                'listTeam' => $listTeam,
                'listUser' => $listUser
            ]);
    }

    public function postNewTeam(CreateTeamRequest $request)
    {
        $team = new Team;
        $team->name = $request->name;
        $team->description = $request->description;
        $team->divisions_id = $request->division;
        $team->leader_id = $request->leader;
        $team->avatar = "icon_team.png";
        $team->save();
        if ($request->leader != '') {
            $user = User::find($request->leader);
            $user->level = 4;
            $user->teams_id = Team::all()->last()->id;
            $user->teams_divisions_id = $request->division;
            $user->save();
        }
       	return redirect()->route('new_team')->with('notification', 'Create a new team successfully.');
    }

    public function getAddMembers($id)
    {
        $team = Team::find($id);
        $usersTeam = User::where('teams_id', $id)->paginate(15);
        return view('user.content.add_members', ['team' => $team, 'usersTeam' => $usersTeam]);
    }

    public function getUpdateTeamInfo($id)
    {
        $team = Team::find($id);
        $listUser = User::where('level', 4)->get();
        $listDivision = Division::all();
        if (Auth::user()->level <= 2) {
            return view('admin.content.update_team_info', ['team' => $team, 
                                                    'listUser' => $listUser, 
                                                    'listDivision' => $listDivision]);
        }
    }

    public function postUpdateTeamInfo(Request $request, $id)
    {
        $team = Team::find($id);
        if (empty($team)) {
            return redirect()->back()->with('error', 'This team not exist, edit unsuccessful.');
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
            if ($team->avatar != null && $team->avatar != 'icon_team.png') {
                File::delete('image/'.$team->avatar);
            }
            $file->move('image', $newNameFile);
            $team->avatar = $newNameFile;
        }
        $team->name = $request->name_team;
        if ($request->leader != '') {
            if ($team->leader_id != $request->leader) {
                if ($team->leader_id != null) {
                    $leader = User::find($team->leader_id);                    
                    $leader->teams_id = 0;
                    $leader->level = 5;
                    $leader->teams_divisions_id = 0;
                    $leader->save();                    
                }
                $team->leader_id = $request->leader;
                $user = User::find($request->leader);
                if ($user->level == 3 && $user->teams_divisions_id != 0) {
                    $divisionLeader = Division::find($user->teams_divisions_id);
                    $divisionLeader->leader_id = null;
                    $divisionLeader->save();
                }
                if ($user->level == 4 && $user->teams_id != 0) {
                    $teamLeader = Team::find($user->teams_id);
                    $teamLeader->leader_id = null;
                    $teamLeader->save();               
                }
                $user->level = 4;
                $user->teams_id = $id;
                if ($team->divisions_id != null) {
                    $user->teams_divisions_id = $team->divisions_id;
                }
                $user->save();
            }
        } elseif ($request->leader == '' && $team->leader_id != $request->leader) {
            $leader = User::find($team->leader_id);
            $leader->teams_id = 0;
            $leader->teams_divisions_id = 0;
            $leader->level = 5;
            $leader->save();
            $team->leader_id = null;
        }        
        if ($team->divisions_id != $request->division) {
            $listUserTeam = User::where('teams_id', $id)->get();
            foreach ($listUserTeam as $userTeam) {
                $userTeam->teams_divisions_id = $request->division;
                $userTeam->save();
            }
        }
        $team->divisions_id = $request->division;
        $team->description = $request->description;
        $team->save();
        return redirect()->back()->with('notification', 'Update team infomation successfully.');        
    }

    public function postEditTeam(Request $request, $id)
    {
        $team = Team::find($id);
        if (empty($team)) {
            return redirect()->back()->with('error', 'This team not exist, edit unsuccessful.');
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $tailFile = $file->getClientOriginalExtension();
            if ($tailFile != 'jpg' && $tailFile != 'png' && $tailFile != 'jpeg') {
                return redirect()->back()->with('error', 'You can only add images with image tail in jpg, png, jpeg');
            }
            $nameFile = $file->getClientOriginalName();
            $newNameFile = str_random(4)."_".$nameFile;
            while (file_exists("public/image/".$newNameFile)) {
                $newNameFile = str_random(4)."_".$nameFile;
            }            
            if ($team->avatar != null && $team->avatar != 'icon_team.png') {
                File::delete('image/'.$team->avatar);
            }
            $file->move('image', $newNameFile);
            $team->avatar = $newNameFile;
        }
        $team->name = $request->name_team;
        $team->divisions_id = $request->division;
        $team->description = $request->description;
        $team->save();
        return redirect()->back()->with('notification', 'Edit team successfully.');
    }

    public function getDeleteTeam($id)
    {
        $team = Team::find($id);
        $members = $team->users();

        foreach ($members as $member) {
            $member = User::find($member->id);
            $member->teams_id = 0;
            $member->teams_divisions_id = 0;
            $member->save();
        }
        if ($team->leader_id != 0) {
            $leader = User::find($team->leader->id);
            $leader->level = 5;
            $leader->teams_id = 0;
            $leader->teams_divisions_id = 0;
            $leader->save();
        }
        $team->delete();        
        return redirect()->route('admin_list_team')->with('notification', 'Delete team successfully.');
    }

    public function getAdAddMem($id)
    {
        $team = Team::find($id);
        $usersTeam = User::where('teams_id', $id)->paginate(15);
        return view('admin.content.add_members', ['team' => $team, 'usersTeam' => $usersTeam]);
    }
}
