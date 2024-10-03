<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HakAkses;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreHakAksesRequest;
use App\Http\Requests\UpdateHakAksesRequest;

class HakAksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.admin.hakAkses.manage', [
            'hak_akses' => HakAkses::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHakAksesRequest $request)
    {

        $validate = $request->validate([
            'nama_hak_akses' => 'required|max:24',
        ]);

        HakAkses::create($validate);


        return redirect("/hak_akses")->with("success", "Hak akses '{$validate['nama_hak_akses']}' berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(HakAkses $hak_akse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HakAkses $hak_akse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHakAksesRequest $request, HakAkses $hak_akse)
    {
        $validate = $request->validate([
            'nama_hak_akses' => 'required|max:24',
        ]);

        HakAkses::where('id', $hak_akse->id)
            ->update($validate);

        return redirect("/hak_akses")->with("success", "Nama hak akses '{$validate['nama_hak_akses']}' berhasil diedit!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HakAkses $hak_akse)
    {

        // Hapus foto user
        User::where('hak_akses_id', $hak_akse->id)->each(function ($user) {
            if ($user->foto != null) {
                Storage::delete($user->foto);
            }
        });

        $hak_akse->delete();
        $hak_akse->user()->delete();
        return redirect("/hak_akses")->with("success", "Nama hak akses '{$hak_akse['nama_hak_akses']}' berhasil dihapus!");
    }
}
