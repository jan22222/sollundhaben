<?php

namespace App\Http\Controllers\Auth;

use auth;
use App\Models\User;
use App\Models\leader;
use App\Models\Update;
use App\Models\enterprise;
use App\Models\invitation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterCoworkerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        return view('auth.registercoworker');
    }

    public function store(Request $request)
    {

        
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'register_code' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);
        //register_code is for the coworker-request to be verified to the enterprise
        //and needs to be send with invitation to coworker
       $gegencheck = invitation::where('email', $request->email)->first()->enterprise_id;
        $enterprise = enterprise::where('register_code', $request->register_code)->first()->id;
        
        //give back error if registercode doesnt match
        if ($enterprise == null||$gegencheck!=$enterprise){
            return back()->with('error', 'No match for enterprise.');
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
            'enterprise_id' => $enterprise
        ]);

        auth()->attempt($request->only('email', 'password'));
        $user = auth()->user();
        $user_name = $user->name;
        $user_id = $user->id;
        $enterprise = $user->enterprise;
        $leader = $enterprise->users->where('is_admin', 1)->first()->id;
        Update::create(
            [
                'user_id' =>$leader,
                'topic'=>'A coworker you invited registered himself',
                'message'=>"Coworker id is $user_id and name is $user_name"
            ]
            );
        return redirect()->route('home');
    }
}

