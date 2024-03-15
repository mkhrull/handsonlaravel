<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Propaganistas\LaravelPhone\Rules\Phone;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    function home()
    {
        return view("auth.login");
    }

    function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $request->only("email" , "password");
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("admindashboard"));
        };
        return redirect(route("login"))->with("error","Login failed");
    }

    function register()
    {
        return view("register");
    }

    function createuser()
    {
        return view("createuser");
    }

    function registerPost(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();

        if ($emailExists) {
            return redirect()->route("register")->with('error', 'Email already exists');
        }

// If email does not exist, continue with registration process   
            
        $request->validate([
                "name" => "required",
                "email" => "required",
                "phonenum" => "required|min:10|max:11",
                "password" => "required|min:8",
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phonenum = $request->phonenum;
            $user->password = Hash::make($request->password);
            if($user->save()){
                return redirect(route("login"))->with("success", "user created successfully!");
            }

            return redirect(route("register"))->with("error", "failed");
    }

    function createuserPost(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();

        if ($emailExists) {
            return redirect()->route("register")->with('error', 'Email already exists');
        }

// If email does not exist, continue with registration process   
            
        $request->validate([
                "name" => "required",
                "email" => "required",
                "phonenum" => "required|min:10|max:11",
                "password" => "required|min:8",
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phonenum = $request->phonenum;
            $user->password = Hash::make($request->password);
            if($user->save()){
                return redirect(route("admindashboard"))->with("success", "user created successfully!");
            }

            return redirect(route("createuser"))->with("error", "failed");
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout(); // Logout the currently authenticated user
            return redirect(route('login'))->with('success', 'You have been logged out successfully.');
        } else {
            return redirect(route('login'))->with('error', 'You are already logged out.');
        }
    }
}
