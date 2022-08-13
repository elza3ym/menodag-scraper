<?php
namespace App\Exports;
use App\Models\Data;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection {


    public function collection()
    {
        return Data::all();
    }
}
