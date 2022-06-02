<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTaskController extends Controller
{
    public function index(){
        $enterprise_id = auth()->user()->enterprise_id;
        $tasks = Task::where('enterprise_id', $enterprise_id)->get();
        return view('admin.tasklist', ['tasks' => $tasks]);
    }
    public function delete($id){    
            $task = Task::find($id);
            $task->delete();
            return back()->with('success', 'Task was deleted successfully.');
    }
    public function show($id){    
        $task = Task::find($id);
        return view('admin.single_task', compact('task'));
    }
}
