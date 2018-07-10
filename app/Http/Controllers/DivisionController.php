<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\CreateDivisionRequest;
use App\Models\Division;
use App\Models\User;
use View;
use App\Models\Team;
use File;

class DivisionController extends Controller
{
    public function getListDivision() 
    {
        $listDivision = Division::paginate(5);
        if (Auth::user()->level <= 2 ) {
            return view('admin.content.list_division', ['listDivision' => $listDivision]);
        }
        return view('user.content.list_division', ['listDivision' => $listDivision]);
    }

    public function getDivisionInfo($id)
    {
        $division = Division::find($id);
        $listTeam= Team::where('divisions_id', $id)->get();
        if (Auth::user()->level <= 2) {
            return view('admin.content.division_info', ['division' => $division, 'listTeam' => $listTeam]);
        }
        return view('user.content.division_info', ['division' => $division]);
        
    }

    public function getNewDivision()
    {
        $listDivision = Division::all();
    	$listUser = User::where('level', 3)->get();
        return view('admin.content.new_division' , ['listUser' => $listUser, 'listDivision' => $listDivision]);
    }

    public function postNewDivision(CreateDivisionRequest $request)
    {
    	$division = new Division;
    	$division->name = $request->name;
    	$division->leader_id = $request->leader;
    	$division->description = $request->description;
    	$division->avatar = 'icon_division.png';
    	$division->save();
        if ($request->leader != '') {
            $user = User::find($request->leader);
            $user->level = 3;
            $user->teams_divisions_id = Division::all()->last()->id;
            $user->teams_id = 0;
            $user->save();
        }
        return redirect()->route('new_division')->with('notification', 'Create a new Division successfully.');
    }

    public function getTeamDivisionInfo($id)
    {
        $division = Division::find($id);
        if (empty($division)) {
            return redirect()->route()->back()->with('warning', 'This team division not exist');
        }
        return view('admin.content.team_division', ['division' => $division]);
    }

    public function postEditDivision(Request $request, $id)
    {
        $division = Division::find($id);
        if (empty($division)) {
            return redirect()->route()->back()->with('warning', 'This team division not exist. Edit division failed');
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
            if ($division->avatar != null && $division->avatar != 'icon_division.png') {
                File::delete('image/'.$division->avatar);
            }
            $file->move('image', $newNameFile);
            $division->avatar = $newNameFile;
        }
        $division->description = $request->description;
        $division->save();
        return redirect()->back()->with('notification', 'Edit division successfully.');
    }

    public function getUpdateDivisionInfo($id)
    {
        $division = Division::find($id);
        $listUser = User::where('level', 3)->get();
        if (Auth::user()->level <= 2) {
            return view('admin.content.update_division_info', ['division' => $division, 'listUser' => $listUser]);
        }        
    }

    public function postUpdateDivisionInfo(Request $request, $id)
    {
        $division = Division::find($id);
        if (empty($division)) {
            return redirect()->route()->back()->with('warning', 'This team division not exist. Edit division failed');
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
            if ($division->avatar != null && $division->avatar != 'icon_division.png') {
                File::delete('image/'.$division->avatar);
            }
            $file->move('image', $newNameFile);
            $division->avatar = $newNameFile;
        }
        if ($request->leader != '') {
            if ($division->leader_id != $request->leader) {
                if ($division->leader_id != null) {
                    $leader = User::find($division->leader_id);
                    $leader->teams_id = 0;
                    $leader->level = 5;
                    $leader->teams_divisions_id = 0;
                    $leader->save();
                }
                $division->leader_id = $request->leader;
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
                $user->level = 3;
                $user->teams_id = 0;
                $user->teams_divisions_id = $id;                
                $user->save();
            }
        } elseif ($request->leader == '' && $division->leader_id != $request->leader) {
            $leader = User::find($team->leader_id);
            $leader->teams_id = 0;
            $leader->teams_divisions_id = 0;
            $leader->level = 5;
            $leader->save();
            $division->leader_id = null;
        }

        $division->name = $request->name_division;
        $division->description = $request->description;
        $division->save();
        return redirect()->back()->with('notification', 'Edit division successfully.');
    }

    public function getDeleteDivision($id)
    {
        $division = Division::find($id);
        if (empty($division)) {
            return redirect()->route()->back()->with('warning', 'This team division not exist. Delete division failed');
        }        
        $teams = $division->teams();
        $members = $division->members();
        foreach ($teams as $team) {
            $team = Team::find($team->id);
            $team->divisions_id = 0;
            $team->save();
        }
        foreach ($members as $member) {
            $member = User::find($member->id);
            $member->teams_divisions_id = 0;
            $member->save();
        }
        if ($division->leader_id != 0) {
            $leader = User::find($division->leader->id);
            $leader->level = 5;
            $leader->teams_divisions_id = 0;
            $leader->save();
        }
        $division->delete();        
        return redirect()->route('admin_list_division')->with('notification', 'Delete division successfully.');
    }
}
