<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tabula;
use Illuminate\Http\Request;
use App\Imports\TabulaImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class createTableController extends Controller
{
    public function index(){
        return view('admin.tabulas.create');
    }
    public function store(Request $request){
            Excel::import(new TabulaImport, request()->file('file'));
            if ($request->input('title')){
            $table = Tabula::latest('created_at')->first();
            $table->title = $request->input('title');
            $table->update();
            }
            return redirect()->back()->with('message', 'Data Imported Successfully');       
    }
}
