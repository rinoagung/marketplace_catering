<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HakAkses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('hakAkses');

        return view('auth.admin.user.edit', [
            'user' => $user,
            'hak_akses' => HakAkses::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $validate = $request->validate([
            'nama' => 'required|max:64',
            'hak_akses_id' => 'required',
        ]);

        if ($request->username !== $user->username) {
            $request->validate([
                'username' => 'required|max:32|unique:users|regex:/^[a-zA-Z0-9_\-]+$/u',
            ]);
            $validate['username'] = $request->username;
        }

        if ($request->password) {
            $request->validate([
                'password' => 'required|min:6',
            ]);
            $validate['password'] = Hash::make($request->password);
        }

        if ($request->file("foto")) {
            $request->validate([
                'foto' => 'image|file|max:5120',
            ]);
            if ($request->old_foto) {
                Storage::delete($request->old_foto);
            }
            $validate['foto'] = $request->file("foto")->store("foto_user");
        }

        User::where('username', $user->username)
            ->update($validate);

        return redirect("/users")->with("success", "User '{$validate['nama']}' berhasil diedit!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->foto) {
            Storage::delete($user->foto);
        }
        $user->delete();

        return redirect("/users")->with("success", "User '{$user->nama}' berhasil dihapus!");
    }
}
