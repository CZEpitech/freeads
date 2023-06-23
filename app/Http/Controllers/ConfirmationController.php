<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function confirm(Request $request)
    {
        $confirmation_token = $request->input('token');
        $user = User::where('confirmation_token', $confirmation_token)->firstOrFail();
        $user->confirmed = true;
        $user->email_verified_at = now();
        $user->save();
        return view('confirmation');
    }
}
