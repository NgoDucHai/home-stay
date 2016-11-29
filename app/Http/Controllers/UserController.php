<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Image;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile', array('user' => Auth::user()));
    }

    public function update_avatar(Request $requests)
    {
        if ($requests->hasFile('image')){
            $image = $requests->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/avatars/'),$imageName);

            $user = Auth::user();
            $user->avatar = $imageName;
            $user->save();
        }
        return view('profile', array('user' => Auth::user()) );
    }
}
