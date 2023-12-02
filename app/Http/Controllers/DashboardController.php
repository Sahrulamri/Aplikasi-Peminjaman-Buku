<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $rentlogs = RentLogs::with(['user', 'book'])->paginate(5);
        return view('dashboard',  [
            'books' => Book::count(),
            'categories' => Category::count(),
            'users' => User::count(),
            'rent_logs' => $rentlogs,
        ]);
    }
}
