<?php

namespace App\Http\Controllers;

use App\Models\enterprise;
use App\Models\invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function show(){
        return view('admin.inviteform');
    }
    public function invite(Request $request) {

        $this->middleware(['is_admin']);

        $this->validate($request,[
            'email' =>'email|required',
            'title' => 'required|max:50',
            'body' => 'required|max:255',
        ]);
        $email = $request->email;
        $enterprise_id = auth()->user()->enterprise_id;
        invitation::create([
            'email' => $email,
            'enterprise_id' => $enterprise_id 
        ]);
        $hashcode = enterprise::where('id', $enterprise_id)->first()->register_code;

        $details = [
            'title' => $request->title,
            'body' => $request->body,
            'hashcode' => $hashcode,
            'email' => $email
        ];
       
        Mail::to($email)->send(new \App\Mail\InfoByMail($details));
        return back()->with('message', 'Coworker successfully invited via email.');
    }
}
