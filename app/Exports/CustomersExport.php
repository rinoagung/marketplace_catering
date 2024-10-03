<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Service::select('id', 'kode_unik', 'nama','device','kendala', 'lokasi', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Kode Unik',
            'Nama',
            'Device',
            'Kendala',
            'Lokasi',
            'Waktu'
        ];
    }
}