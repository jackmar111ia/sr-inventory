<?php

namespace App\Imports;

use App\Models\admin\wpData;
use Maatwebsite\Excel\Concerns\ToModel;

class WpDataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new wpData([
            'title' => $row['title'],
            'image' => $row['resize_image'],
        ]);
    }
}
