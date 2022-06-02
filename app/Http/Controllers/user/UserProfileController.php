<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function show()
    {
        return view('user.profile');
    }

    public function upload(Request $request)
    {
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            $user = auth()->user();
            $user->update(['image'=>$filename]);
        }
        else return redirect()->back()->with('error', 'You have to pick a valid file.');
        return redirect()->back()->with('message', 'Picture successfully loaded!');
    }
}