<?php

namespace App\Http\Controllers;

use App\Helpers\DashboardHelper;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function awal(){
        $menu = 'dashboard';

        $data = DashboardHelper::getDashboardStats();
        // dd($data);
        return view('app.dashboard.index',compact('menu', 'data'));
    }
}
