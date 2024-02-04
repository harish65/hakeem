<?php

namespace App\Imports;

use App\Model\Pincode;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PincodeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Pincode::updateOrCreate(['pincode'=>$row[0]], ['pincode'=>$row[0]]);
    }
}
