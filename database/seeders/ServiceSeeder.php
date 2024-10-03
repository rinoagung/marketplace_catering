<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'user_id' => 2,
            'menu_id' => 1,
            'jumlah' => 3,
            'status' => 'menunggu'
        ]);
        Service::create([
            'user_id' => 2,
            'menu_id' => 2,
            'jumlah' => 2,
            'status' => 'proses'
        ]);
        Service::create([
            'user_id' => 2,
            'menu_id' => 3,
            'jumlah' => 3,
            'status' => 'tunda'
        ]);
        Service::create([
            'user_id' => 2,
            'menu_id' => 4,
            'jumlah' => 1,
            'status' => 'selesai'
        ]);
    }
}
