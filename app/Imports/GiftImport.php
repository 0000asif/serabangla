<?php

namespace App\Imports;

use App\Models\Gift;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GiftImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Gift([
            'name'  => $row['name'],
            'value' => $row['value'],
        ]);
    }
}