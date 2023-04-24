<?php

namespace App\Exports;

use App\Models\Salarie;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalarieExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Salarie::all();
    }
}
