<?php

namespace App\Http\Controllers\admin;

use auth;
use App\Models\Update;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        $updates = Update::where('user_id' , $user_id)->get();
        return view('admin.dashboard', compact('updates'));
    }
    public function home(){
            return view('admin.home');
    }
    
}
