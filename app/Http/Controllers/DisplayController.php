<?php

namespace App\Http\Controllers;

use App\Models\ViewConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DisplayController extends Controller
{
    public function index()
    {
        $konfigurasi = ViewConfig::first();
        return view('auth.admin.display.edit', [
            'konfigurasi' => $konfigurasi
        ]);
    }
    public function update(Request $request)
    {

        $validate = $request->validate([
            'alamat' => '',
            'no_telp' => '',
            'email' => '',
            'situs_web' => '',
            // 'waktu_slide' => 'required',
            // 'teks_berjalan' => '',
        ]);

        ViewConfig::where('id', $request->user_id)
            ->update($validate);

        return redirect('/displayConfig')->with("success", "Konfigurasi berhasil di update!");
    }
}
