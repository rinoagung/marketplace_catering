<?php

namespace Database\Seeders;

use App\Models\HakAkses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // HakAkses::create([
        //     'nama_hak_akses' => 'Admin',
        // ]);
        HakAkses::create([
            'nama_hak_akses' => 'Merchant',
        ]);
        HakAkses::create([
            'nama_hak_akses' => 'Customer',
        ]);
    }
}
