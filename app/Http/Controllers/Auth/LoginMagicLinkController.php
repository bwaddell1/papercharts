<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginMagicLinkController extends Controller
{

    public function loginWithMagicLink(Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        if ($user) {
            auth()->login($user);

            return redirect('/dashboard');
        }

        return redirect('/login')->with('status', 'Invalid magic link!');
    }

    public function sendMagicLink(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->sendMagicLinkNotification();
            return back()->with('status', 'Magic link sent! Please check your email.');
        }
        else {
            return back()->with('status', 'Email incorrect! Please try another email.');
        }

    }
}
