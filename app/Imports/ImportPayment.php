<?php

namespace App\Imports;

use App\Models\Admin\Payment;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPayment implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Payment([
            'first_name' => $row[0],
           'last_name' => $row[1],
        ]);
    }
}
