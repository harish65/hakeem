<?php

namespace App\Exports;

use App\Model\Pincode;
use Maatwebsite\Excel\Concerns\FromCollection;

class PincodeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pincode::select('pincode')->limit(5)->get();
    }
}
