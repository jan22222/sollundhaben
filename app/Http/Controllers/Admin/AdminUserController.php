<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index(){
        $enterprise_id = auth()->user()->enterprise_id;
        $users = User::where('enterprise_id', $enterprise_id)->where('is_admin','0')->get();
        return view('admin.userlist', compact('users'));
    }
    public function show($id){
        $user = User::where('id',  $id)->first();
        return view('admin.user', compact('user'));
    }

}
