<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HakAkses;
use App\Models\ViewConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->konfigurasi = ViewConfig::first();
    }

    public function index()
    {
        return view("guest.login", [
            "title" => "Login",
            "active" => "login",
            'konfigurasi' => $this->konfigurasi
        ]);
    }

    public function register()
    {
        return view(
            'guest.register',
            [
                'hak_akses' => HakAkses::get(),
                'konfigurasi' => $this->konfigurasi
            ]
        );
    }

    public function signup(Request $request)
    {
        // var_dump($request['hak_akses']);
        // die;
        $validate = $request->validate([
            'nama' => 'required|max:64',
            'username' => 'required|max:32|unique:users|regex:/^[a-zA-Z0-9_\-]+$/u',
            'password' => 'required|min:6',
            'hak_akses_id' => 'required',
            'id_kota' => 'required',
            'alamat' => 'required',
            'foto' => 'image|file|max:5120',
        ], [
            'nama.required' => 'Harap isi data ini',
            'username.required' => 'Harap isi data ini',
            'username.unique' => 'Username sudah terdaftar',
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, garis bawah, dan tanda hubung',
            'password.required' => 'Harap isi data ini',
            'password.min' => 'Password minimal terdiri dari 6 karakter',
            'hak_akses_id.required' => 'Harap isi data ini',
            'id_kota.required' => 'Harap isi data ini',
            'alamat.required' => 'Harap isi data ini',
            'foto.image' => 'File yang diunggah harus berupa gambar',
            'foto.file' => 'File yang diunggah harus berupa file',
            'foto.max' => 'Ukuran file maksimal adalah 5 MB',
        ]);

        if ($request->file("foto")) {
            $validate['foto'] = $request->file("foto")->store("foto_user");
        }

        $validate["password"] = Hash::make($validate["password"]);

        User::create($validate);

        return redirect("/")->with("success", "User '{$validate['nama']}' berhasil ditambahkan!");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::where('username', $credentials['username'])->first();

            $user->update(['login_terakhir' => now()]);
            if ($user->hak_akses_id == 1) {
                return redirect()->intended("/dashboard");
            } else {
                return redirect()->intended("/{$user->hak_akses_id}/service");
            }
        }

        return back()->with("loginError", "Incorrect username or password.");
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect("/");
    }
}
