<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $userAll = User::count();
        $userToday = User::whereDate('created_at', Carbon::today())->count();

        $workAll = Work::count();
        $workToday = Work::whereDate('created_at', Carbon::today())->count();

        return view('home')->with('data' ,[
            'userAll' => $userAll,
            'userToday' => $userToday,
            'workAll' => $workAll,
            'workToday' => $workToday
        ]);
    }
}
