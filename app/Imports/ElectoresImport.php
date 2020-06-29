<?php

namespace App\Imports;

use App\Elector;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ElectoresImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Elector([
            'ci'     => $row['ci'],
            'nombres'    => $row['nombres'],
            'mesa'    => $row['mesa']
//            'password' => Hash::make($row['password']),
        ]);
    }
}
