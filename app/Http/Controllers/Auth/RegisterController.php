<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\leader;
use App\Models\enterprise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'enterprisename' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);
        //register_code is for the coworker-request to be verified to the enterprise
        //and needs to be send with invitation to coworker
        $enterprise = Enterprise::create([
            'name' =>  $request->enterprisename,
            'register_code' => Hash::make(time()),
        ]);

        $enterprise_id = $enterprise->id;
        
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
            'enterprise_id' => $enterprise_id,
        ]);
      
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('admin.home');
    }
}
