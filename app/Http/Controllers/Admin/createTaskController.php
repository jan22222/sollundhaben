<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Tabula;
use App\Models\Update;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class createTaskController extends Controller
{
    public function index(){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
        //Alle Coworker finden:

        $enterprise_id = auth()->user()->enterprise_id;  
        $users = User::where('enterprise_id', $enterprise_id)
            ->where('is_admin', 0)
            ->get();

        $tables = Tabula::where('enterprise_id', $enterprise_id)
            ->get();
            if ($tables->first() && $users->first()) {
                    return view('admin.create_task')
                    ->with('users', $users)->with('tables', $tables);
            } else
            {dd('fehler');}
    
  }

    public function store(Request $request){
       
        $this->validate($request, [
            'title' => 'required|max:255',
            'user_id' => 'required|max:255',
            'description' => 'required|max:255',
            'table_id' => 'required|max:255|unique:tasks,tabula_id'
          
        ]);
        //get enterprise info from auth middleware
        $enterprise_id = auth()->user()->enterprise_id;
        //create task 
        Task::create([
            'title' =>  $request->title,
            'user_id' =>  $request->user_id,
            'body' =>  $request->description,
            'tabula_id' =>  $request->table_id,
            'enterprise_id' =>$enterprise_id,
        ]);
        Update::create(
            [
                'topic' => 'You have got a new task.',
                'message' => 'Look at the task section, title: '.$request->title,
                'user_id' => $request->user_id
            ]
            );
     return back()->with('message', 'Task successfully created');
    }
}
