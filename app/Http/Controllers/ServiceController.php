<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Service;
use App\Models\ViewConfig;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->konfigurasi = ViewConfig::first();
    }

    public function index()
    {
        return view("service.index", [
            'menu' => Menu::get(),
            "title" => "Login",
            "active" => "login",
            'konfigurasi' => $this->konfigurasi,
            'customers' => Service::with(['users', 'menu'])
                ->where('user_id', auth()->user()->id)
                ->get()
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
    public function store(Request $request)
    {

        $request->validate([
            'orders.*.menu_id' => 'required|exists:menus,id',
            'orders.*.jumlah' => 'required|integer|min:1',
        ]);

        foreach ($request->orders as $order) {
            Service::create([
                'user_id' => auth()->id(),
                'menu_id' => $order['menu_id'],
                'jumlah' => $order['jumlah'],
                'status' => 'menunggu',
            ]);
        }

        return redirect()->back()->with('success', 'Pesanan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {

        if ($request->status == 'proses') {
            $alert = 'secondary';
            $message = 'Antrian sedang diproses';
        } elseif ($request->status == 'tunda') {
            $alert = 'warning';
            $message = 'Antrian ditunda';
        } else {
            $alert = 'success';
            $message = 'Antrian Berhasil diselesaikan';
        }


        $validate = $request->validate([
            'status' => 'required',
        ]);

        Service::where('id', $service->id)
            ->update($validate);

        return redirect()->back()->with($alert, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
