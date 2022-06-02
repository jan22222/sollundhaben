<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Update;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    public function index(){
    
    }
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
