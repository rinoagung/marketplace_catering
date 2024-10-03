<?php

namespace Database\Seeders;

use App\Models\ViewConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ViewConfig::create([
            'user_id' => 1,
            'alamat' => 'Jl. Gunung Latimojong No.23, Gaddong, Kec. Bontoala',
            'no_telp' => '08992797833',
            'email' => 'info@katering_jkt.co.id',
            'situs_web' => 'katering_jkt.co.id',
        ]);

        ViewConfig::create([
            'user_id' => 2,
            'alamat' => 'Jl. Lingkar Utara No.23, Jansen, Kec. Bandung Utara',
            'no_telp' => '08993297833',
            'email' => 'info@kantor_bandung.co.id',
            'situs_web' => 'kantor_bandung.co.id',
        ]);
    }
}
