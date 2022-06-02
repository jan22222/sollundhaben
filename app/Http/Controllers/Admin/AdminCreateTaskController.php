<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Update;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCreateTaskController extends Controller
{
    public function index(){
        $enterprise_id = auth()->user()->enterprise_id;
        $users = User::where('enterprise_id', $enterprise_id)->where('is_admin', 0)->get();
        return view('admin.create_task', compact('users'));
    }
    public function create(Request $request){
        Task::create([
            'title' => $request->title,
            'body' => $request->description,
            'user_id' => $request->user_id,
        ]);
        auth()->attempt($request->only('email', 'password'));
        
        Update::create(
            [
                'user_id' =>$request->user_id,
                'topic'=>'You have got a new task.',
                'message'=>$request->title
            ]
            );
        return back();
    }
}
