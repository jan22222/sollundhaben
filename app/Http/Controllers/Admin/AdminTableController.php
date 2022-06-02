<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tabula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTableController extends Controller
{  
    // public function index(){
    //     $tabulas = Tabula::all();
    //     return $tabulas;
    // }
    // public function show(){
    //     return view('admin.vuetabulas');
    // }
    // public function table($id){
    //     $tabula = Tabula::find($id);
    //     return view('admin.vuetabulas', compact('tabula'));
    // }


    //show all tables: index
    public function index()
    {
        $tabulas = Tabula::latest()->paginate(5);
    
        return view('admin.tabulas.index', compact('tabulas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //import tables, i that special case it is by import
    //closed
    public function create()
    {
        $tabula = Tabula::all();
        return view('admin.tabulas.importtable', compact('tabula'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //because of the import a store function ommits
    // public function store(Request $request)
    
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    //eine einzelne Tabelle: show gibt es nicht, weil die edit seite identisch ist
    // public function show(Tabula $tabula)
    // {
    //     return view('admin.tabulas.vuetabulas', compact('tabula'));
    // } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    // edit view
    // public function edit($id)
    // {
    //     $tabula = Tabula::find($id);
    //     return view('admin.tabulas.vuetabulas', compact('tabula'));
    // }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
 
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    //hier müsste man den access nochmal checken
    public function delete($id)
    {    
            $table = Tabula::find($id);
            $table->delete();
            return back()->with('success', 'Table was deleted successfully.');
    }
}
