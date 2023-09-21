<?php

namespace App\Http\Controllers;

use App\Events\ZapierEvent;
use App\Models\TeamInvitation;
use App\Models\User;
use App\Models\Role;
use Auth;
use Event;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function accept(Request $request, TeamInvitation $invitation)
    {
        if ($this->userDoesNotExist($invitation->email)) {
            return view('theme::auth.register-invitation', compact('invitation'));
        }
        $role = Role::where('name', '=', $invitation->role)->first();
        $team = $invitation->team;
        $user = User::where('email', '=', $invitation->email)->first();
        $team->users()->attach($user, ['role' => $invitation->role]);
        $user->switchTeam($team);
        $user->role_id = $role->id;
        $user->save();
        $team->updateSeats($team->provider_count());
        $invitation->delete();
        Auth::login($user);
        return redirect('/dashboard')->banner(
            __('Great! You have accepted the invitation'),
        );
    }

    private function userDoesNotExist($email)
    {
        return User::where('email', $email)->first() ? false : true;
    }

    public function register(Request $request, TeamInvitation $invitation)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|min:2|max:191',
            'username' => 'required|string|max:20|unique:users',
            'password' => 'required|min:5|max:191|confirmed',
        ]);

        # User
        $user = $this->createUser($validated, $invitation->role);

        $invitation->team->users()->attach($user, ['role' => $invitation->role]);

        $invitation->delete();
        $invitation->team->updateSeats($invitation->team->provider_count());

        // TODO: Auth/login doesn't work
        Auth::login($user);

        return redirect('/dashboard')->banner(
            __('Great! You have accepted the invitation'),
        );
    }

    private function createUser($data, $role)
    {
        $role = Role::where('name', '=', $role)->first();
        
        if(isset($data['username']) && !empty($data['username'])){
            $username = $data['username'];
        } elseif(isset($data['name']) && !empty($data['name'])) {
            $username = Str::slug($data['name']);
        } else {
            $username = $this->getUniqueUsernameFromEmail($data['email']);
        }

        $username_original = $username;
        $counter = 1;

        while(User::where('username', '=', $username)->first()){
            $username = $username_original . (string)$counter;
            $counter += 1;
        }

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->username = $username;
        $user->password = bcrypt($data['password']);
        $user->role_id = $role->id;
        $user->verification_code = "";
        $user->verified = true;
        $user->trial_ends_at = now();
        $user->save();

        return $user;
    }
}
