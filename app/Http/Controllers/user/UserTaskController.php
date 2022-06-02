<?php

namespace App\Http\Controllers\user;

use App\Models\Task;
use App\Models\Update;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTaskController extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        $tasks = Task::where('user_id', $user_id)->where('completed_at', Null)->get();
        return view('user.tasklist', compact('tasks'));
    }
    public function show($id){
        $user_id = auth()->user()->id;
        $task = Task::where('user_id', $user_id)
        ->where('id', $id)
        ->first();
        return view('user.task', compact('task'));
    }
    public function show_completion($id){
        $user_id = auth()->user()->id;
        $task = Task::where('user_id', $user_id)
        ->where('id', $id)
        ->first();
        return view('user.task_completion', compact('task'));
    }
    public function make_completion(task $task){
        $task_id = $task->id;
        $task->completed_at = now();
        $task->save();
        $user = auth()->user();
        $user_id = $user->id;
        $l_id = $user->enterprise->users->where('is_admin', 1)->first()->id;
        Update::create(
            [
                'user_id' =>$l_id,
                'topic'=>'A coworker completed a task. ',
                'message'=>"Coworker id is $user_id , Task id is $task_id"
            ]
            );
        return redirect()->route('user.tasklist')->with('message', 'successfully completed');
    }
}
