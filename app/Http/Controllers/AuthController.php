<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function registerProcess(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:7',
            'phone' => 'max:255',
            'address' => 'required'
        ]);

        $validate['password'] = bcrypt($validate['password']);
        $user = User::create($request->all());

        Session::flash('status', 'success');
        Session::flash('message', 'Registration Has Been Successfully Pleat Wait Admin For Approved Your Account!');
        return redirect('/register');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // cek login valid

        if (Auth::attempt($credentials)) {
            // cek user status active
            if (Auth::user()->status != 'active') {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Your Account is Not Activated yet By Admin');
                return redirect('/login');
            }
            $request->session()->regenerate();

            if (Auth::user()->role_id == 1) {
                return redirect('dashboard');
            }

            if (Auth::user()->role_id == 2) {
                return redirect('profile');
            }

            // return redirect();
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Login Invalid');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
