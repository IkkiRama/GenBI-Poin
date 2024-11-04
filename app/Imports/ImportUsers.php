<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ImportUsers implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'email' =>$row[1],
            'password' =>Hash::make($row[2]),
            'komsat' =>$row[3],
            'bidang' =>$row[4],
        ]);
    }
}
