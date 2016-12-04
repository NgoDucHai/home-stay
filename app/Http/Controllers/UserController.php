<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile', array('user' => Auth::user()));
    }

    public function avatar(Request $requests)
    {
        if ($requests->hasFile('avatar')){
            $image = $requests->file('avatar');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/avatars/'),$imageName);
            $user = Auth::user();
            $user->avatar = $imageName;
            $user->save();
        }
        return view('profile', array('user' => Auth::user()) );
    }

    public function update($id)
    {
        $user = User::find($id);
        $user->name       = Input::get('name');
        $user->email      = Input::get('email');
        $user->phone      = Input::get('phone');
        $user->age      = Input::get('age');
        $user->description = Input::get('description');
        $user->save();
        return view('profile', array('user' => $user));
    }

    public function get($id)
    {

        $user = \DB::table('users')->where('id', $id)->first();
        return view('profile', array('user' => $user));
    }

}
