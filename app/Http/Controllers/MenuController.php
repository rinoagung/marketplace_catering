<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_quantity = ['5', '10', '50', '100'];

        return view('auth.admin.menu.manage', [
            'menu' => Menu::filter(request(["search"]))->paginate(request('data_quantity') ?: 5)->withQueryString(),

            'data_quantity' => $data_quantity,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'auth.admin.menu.tambah'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // var_dump($request['hak_akses']);
        // die;
        $validate = $request->validate([
            'nama' => 'required|max:64',
            'deskripsi' => 'required',
            'harga' => 'required',
            'foto' => 'image|file|max:5120',
        ]);

        $validate['katering_id'] = auth()->user()->id;

        if ($request->file("foto")) {
            $validate['foto'] = $request->file("foto")->store("foto_menu");
        }

        Menu::create($validate);

        return redirect("/menu")->with("success", "Menu '{$validate['nama']}' berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {

        return view('auth.admin.menu.edit', [
            'menu' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {

        $validate = $request->validate([
            'nama' => 'required|max:64',
            'deskripsi' => 'required',
            'harga' => 'required',
            'foto' => 'image|file|max:5120',
        ]);

        if ($request->file("foto")) {
            $request->validate([
                'foto' => 'image|file|max:5120',
            ]);
            if ($request->old_foto) {
                Storage::delete($request->old_foto);
            }
            $validate['foto'] = $request->file("foto")->store("foto_menu");
        }

        Menu::where('id', $menu->id)
            ->update($validate);

        return redirect("/menu")->with("success", "Menu '{$validate['nama']}' berhasil diedit!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {

        if ($menu->foto) {
            Storage::delete($menu->foto);
        }
        $menu->delete();

        return redirect("/menu")->with("success", "Menu '{$menu->nama}' berhasil dihapus!");
    }
}
