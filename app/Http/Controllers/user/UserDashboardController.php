<?php

namespace App\Http\Controllers\user;

use App\Models\Update;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        $updates = Update::where('user_id' , $user_id)->get();
        return view('user.dashboard', compact('updates'));
    }
    public function home(){
        return view('user.home');
    }
}
