<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'hak_akses_id' => '1',
            'nama' => 'Katering Jkt',
            'username' => 'katering_jkt',
            'foto' => null,
            // 'password' => '$2y$10$bMrxHVudx3JdEYd/qEh9NuEdFCVbBJwTdFbEoWUNuD4q4gjzi/WIq', // punyamegdi
            'password' => '$2y$12$fyr1yFYoAFf.QwebSfUrX.7zYkVDMck/KujaDlPsObNT.Ru4k9cji', // katering_1
            'id_kota' => 1,
            'alamat' => 'Jalan Lama no 18',
            'login_terakhir' => now(),
        ]);
        User::create([
            'hak_akses_id' => '2',
            'nama' => 'Kantor Samsung',
            'username' => 'kantor_samsung',
            'foto' => null,
            // 'password' => '$2y$12$Svv3/B2IAmzqJBkYstpWY.86M14uMGRbHImEjvwWNPlsarjiJSL2a', // loket_1
            'password' => '$2y$12$oy4Q6ixgTblTcp/KCerRMuI1rorKfZaNUsxkRXXC2snd3UTZj0F9e', // samsung1
            'id_kota' => 2,
            'alamat' => 'Jalan Baru no 17',
            'login_terakhir' => now(),
        ]);
    }
}
