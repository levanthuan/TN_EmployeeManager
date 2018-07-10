<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function getLogin()
    {
    	return view('index');
    }

    public function postLogin(LoginRequest $request)
    {
    	$email = $request->email;
    	$password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
        	$user = User::find(auth()->id());
        	if ($user->level <= 2) {
        		return redirect()->route('admin_home')->with('notification', 'Login successful');
        	} 
        	return redirect()->route('user_home')->with('notification', 'Login successful');
        }
        return redirect('')->with('error', 'Sign in failed, please try again later!');
    }

    public function getLogout(){    
    	Auth::logout();
    	return redirect()->route('login');
    }
}
