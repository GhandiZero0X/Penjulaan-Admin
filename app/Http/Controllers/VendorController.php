<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    // Menampilkan semua data vendor
    public function index()
    {
        $vendors = DB::table('vendor')
            ->where('status_aktif', 1) // Hanya tampilkan yang belum dihapus
            ->get();

        return view('vendor.index', compact('vendors'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return view('vendor.create');
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $data = [
            'nama_vendor' => $request->nama_vendor,
            'badan_hukum' => $request->badan_hukum,
            'status' => $request->status,
        ];

        DB::table('vendor')->insert($data);

        return redirect()->route('vendor.index')->with('success', 'Data vendor berhasil disimpan.');
    }

    // Menampilkan form untuk mengedit data
    public function edit($id)
    {
        $vendor = DB::table('vendor')
            ->where('idvendor', $id)
            ->where('status_aktif', 1)
            ->first();

        return view('vendor.edit', compact('vendor'));
    }

    // Memperbarui data di database
    public function update(Request $request, $id)
    {
        $data = [
            'nama_vendor' => $request->nama_vendor,
            'badan_hukum' => $request->badan_hukum,
            'status' => $request->status,
        ];

        DB::table('vendor')
            ->where('idvendor', $id)
            ->where('status_aktif', 1)
            ->update($data);

        return redirect()->route('vendor.index')->with('success', 'Data vendor berhasil diperbarui.');
    }

    // Melakukan soft delete pada data
    public function softDelete($id)
    {
        DB::table('vendor')
            ->where('idvendor', $id)
            ->update(['status_aktif' => 0]);

        return redirect()->route('vendor.index')->with('success', 'Data vendor berhasil dihapus.');
    }
}
