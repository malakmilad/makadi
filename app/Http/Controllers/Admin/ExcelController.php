<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPayment;
use App\Exports\ExportPayment;


class ExcelController extends Controller
{
    public function import(Request $request){
        Excel::import(new ImportPayment,
        $request->file('file')->store('files'));
        return redirect()->back();
    }
    public function export(Request $request){
        return Excel::download(new ExportPayment,'payment.xlsx');
    }
}
