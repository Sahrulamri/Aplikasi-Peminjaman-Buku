<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', Auth::user()->id)->paginate(5);
        return view('profile', [
            'rent_logs' => $rentlogs,
        ]);
    }

    public function index()
    {
        return view('users', [
            'users' => User::where('role_id', 2)->where('status', 'active')->get()
        ]);
    }

    public function registered()
    {
        return view('users.registered', [
            'registeredUsers' => User::where('status', 'inactive')->where('role_id', 2)->get()
        ]);
    }

    public function show($slug)
    {

        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', $user->id)->paginate(5);
        return view('users.detail', [
            'user' => $user,
            'rent_logs' => $rentlogs
        ]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();

        return redirect('/users/detail/' . $slug)->with('success', 'User Register Has Been Approved Successfully!');
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();

        return redirect('/users')->with('success', 'User Has Been Banned Successfully!');
    }

    public function banned()
    {
        return view('users.banned', [
            'bannedUsers' => User::onlyTrashed()->get()
        ]);
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();

        return redirect('/users')->with('success', 'User Has Been Restored Successfully!');
    }
}
