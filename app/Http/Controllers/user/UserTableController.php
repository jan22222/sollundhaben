<?php

namespace App\Http\Controllers\user;

use App\Models\Tabula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTableController extends Controller
{  
    public function index()
    {
        $tabulas = Tabula::latest()->paginate(5);
    
        return view('user.tabulas.index', compact('tabulas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //import tables
    public function create()
    {
        $tabula = Tabula::all();
        return view('user.tabulas.importtable', compact('tabula'));
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

     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    // edit view
    public function edit($id)
    {
        $tabula = Tabula::find($id);
        return view('user.tabulas.vuetabulas', compact('tabula'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    
    //post an update
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'soll' => 'required',
            'haben' => 'required',
        ]);
        $tabula = Tabula::find($request->id);
        $tabula->update($request->all());
        return redirect()->back()->with('message','Product updated successfully');
    }
    
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
