<?php

namespace App\Exports;

use App\Models\admin\wpData;
use Maatwebsite\Excel\Concerns\FromCollection;

class WpDataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return wpData::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'title',
            'Image',
            'Created At',
            'Updated At',
        ];
    }

}
