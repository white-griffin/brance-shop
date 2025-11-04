<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date as FacadeDate;

class DashboardController extends Controller
{
    public function index()
    {
        $allUsers = User::count();
        $yesterdayJoinedUsers = User::whereDate('created_at',Carbon::yesterday())->count();
        $todayJoinedUsers = User::whereDate('created_at',Carbon::today())->count();
        $todayLogin_count = User::whereDate('updated_at','>',FacadeDate::yesterday())->count();
        return view('admin.dashboard',compact('allUsers','yesterdayJoinedUsers','todayJoinedUsers','todayLogin_count'));
    }
}
