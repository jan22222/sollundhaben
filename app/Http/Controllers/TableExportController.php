<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TablesExport;
use Maatwebsite\Excel\Facades\Excel;

class TableExportController extends Controller
{
    public function export(Request $request){
        return Excel::download(new TablesExport($request->id), 'table.xlsx');
    }
}