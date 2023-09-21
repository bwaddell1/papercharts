<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamUser;
use App\Models\Role;

class ProfileController extends Controller
{
    public function index($username){
    	$user = config('wave.user_model')::where('username', '=', $username)->firstOrFail();
    	return view('theme::profile', compact('user'));
    }

    public function update_role(Request $request)
    {
        if($request->user_id && $request->team_id) {
            $team_user = TeamUser::where("user_id", $request->user_id)->where("team_id", $request->team_id)->first();
            $user = $team_user->user;
            $user->role_id = Role::where('name', $request->role)->first()->id;
            $user->save();
            $team_user->team->updateSeats(count($team_user->team->providers()));
        }
        return redirect()->back();
    }
}
