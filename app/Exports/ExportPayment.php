<?php

namespace App\Exports;

use App\Models\Admin\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPayment implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payment::all();
    }
}
