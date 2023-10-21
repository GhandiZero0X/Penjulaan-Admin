<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarginPenjualanController extends Controller
{
    // Menampilkan semua data margin penjualan dengan nama user
    public function index()
    {
        $margins = DB::table('margin_penjualan')
            ->join('user', 'margin_penjualan.iduser', '=', 'user.iduser')
            ->where('margin_penjualan.status_aktif', 1)
            ->select('margin_penjualan.*', 'user.nama_user')
            ->get();

        return view('margin_penjualan.index', compact('margins'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return view('margin_penjualan.create');
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $data = [
            'created_at' => now(),
            'persen' => $request->persen,
            'STATUS' => $request->STATUS,
            'iduser' => $request->iduser,
            'updated_at' => now(),
        ];

        DB::table('margin_penjualan')->insert($data);

        return redirect()->route('margin_penjualan.index')->with('success', 'Data margin penjualan berhasil disimpan.');
    }

    // Menampilkan form untuk mengedit data
    public function edit($id)
    {
        $margin = DB::table('margin_penjualan')
            ->where('idmargin_penjualan', $id)
            ->where('status_aktif', 1)
            ->first();

        return view('margin_penjualan.edit', compact('margin'));
    }

    // Memperbarui data di database
    public function update(Request $request, $id)
    {
        $data = [
            'persen' => $request->persen,
            'STATUS' => $request->STATUS,
            'iduser' => $request->iduser,
            'updated_at' => now(),
        ];

        DB::table('margin_penjualan')
            ->where('idmargin_penjualan', $id)
            ->where('status_aktif', 1)
            ->update($data);

        return redirect()->route('margin_penjualan.index')->with('success', 'Data margin penjualan berhasil diperbarui.');
    }

    // Melakukan soft delete pada data
    public function softDelete($id)
    {
        DB::table('margin_penjualan')
            ->where('idmargin_penjualan', $id)
            ->update(['status_aktif' => 0]);

        return redirect()->route('margin_penjualan.index')->with('success', 'Data margin penjualan berhasil dihapus.');
    }
}
