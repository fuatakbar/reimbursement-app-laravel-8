<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

// models
use App\Models\User;

class UserController extends Controller
{
    public function changeName(Request $req){
        $req->validate([
            'firstname' => 'required|min:3|max:50',
            'lastname' => 'required|min:3|max:50'
        ]);

        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $user->firstname = $req->firstname;
        $user->lastname = $req->lastname;
        $save = $user->save();

        if ($user) {
            return redirect()->back()->with(['message' => 'Change Name SUCCESS.']);
        } else {
            return redirect()->back()->with(['message' => 'Change Name FAILED.']);
        }
    }

    public function changePassword(Request $req){
        $validator = $req->validate([
            'oldpassword' => 'required|min:8',
            'newpassword' => 'required|min:8'
        ], 
        [
            'oldpassword.required' => 'The old password cannot be empty.',
            'oldpassword.min' => 'The old password must be at least minimum 8 character.',
            'newpassword.required' => 'The new password cannot be empty.',
            'newpassword.min' => 'The new password must be at least minimum 8 character'
        ]);

        $user = $user = User::where('id', Auth::user()->id)->firstOrFail();

        if (Hash::check($req->oldpassword, $user->password)) {
            $user->password = Hash::make($req->newpassword);
            $save = $user->save();

            if ($save) {
                return redirect()->back()->with(['message' => 'Password Changed SUCCEED']);
            } else {
                return redirect()->back()->with(['message' => 'Password Changed FAILED']);
            }
        } else {
            return redirect()->back()->with(['message' => 'Old Password Not Match']);
        }

    }
}
