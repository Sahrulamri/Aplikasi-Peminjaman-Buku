<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RentLogs;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index()
    {

        $rentlogs = RentLogs::with(['user', 'book'])->paginate(5);
        return view('rentLogs', [
            'rent_logs' => $rentlogs,

        ]);
    }
}
