<?php

namespace App\Http\Controllers\user;

use App\Models\Update;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserUpdateController extends Controller
{
    //alle neuen updates spiegeln
    public function index(){
    
    }
    //wieviele neue Updates gibt es? (für ajax)
    public function new(){
        $user_id = auth()->user()->id;
        $number = Update::where('checked', false)->where('user_id', $user_id)->get()->count();
        return $number;
    }
    //user schaut updates an, alle werden gecheckt
    public function check(){
        $user_id = auth()->user()->id;
   
        $updates = Update::where('user_id', $user_id)
        ->where('checked', 0)
        ->get();
  
        foreach($updates as $update){
            $update->checked = 1;
            $update->save();
        }
        return back();
    }
}
