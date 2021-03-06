<?php

namespace App\Http\Controllers\User;

use Auth, Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserChangePasswordController extends Controller
{
    //
    public function index()
    {
    	return view('user.change-password');
    }

    public function userChangePassword(Request $request)
    {
    	$request->validate([
    		'current_password' => 'required',
    		'password' => 'required|string|min:6|confirmed',
    		'password_confirmation' => 'required',
    			]);
    	$user = Auth::user();
    	if(!Hash::check($request->current_password,$user->password)){
    		return back()->with('error','Current password does not match!');
    	}

    	$user->password = Hash::make($request->password);
    	$user->save();

    	return back()->withSuccess(__('Password changed successfully'));
    }
}
