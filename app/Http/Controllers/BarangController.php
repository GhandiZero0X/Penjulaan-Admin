<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    // Menampilkan semua data barang beserta satuan
    public function index()
    {
        $barang = DB::table('barang')
            ->select('barang.idbarang', 'barang.jenis', 'barang.nama', 'barang.harga', 'satuan.nama_satuan')
            ->join('satuan', 'barang.idsatuan', '=', 'satuan.idsatuan')
            ->where('barang.status_aktif', 1) // Hanya tampilkan yang belum dihapus
            ->get();

        return view('pages.admins.barang', compact('barang'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        $satuan = DB::table('satuan')
            ->where('status_aktif', 1)
            ->get();

        return view('barang.create', compact('satuan'));
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $data = [
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'idsatuan' => $request->idsatuan,
            'harga' => $request->harga,
        ];

        DB::table('barang')->insert($data);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil disimpan.');
    }

    // Menampilkan form untuk mengedit data
    public function edit($id)
    {
        $barang = DB::table('barang')
            ->where('idbarang', $id)
            ->where('status_aktif', 1)
            ->first();

        $satuan = DB::table('satuan')
            ->where('status_aktif', 1)
            ->get();

        return view('barang.edit', compact('barang', 'satuan'));
    }

    // Memperbarui data di database
    public function update(Request $request, $id)
    {
        $data = [
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'idsatuan' => $request->idsatuan,
            'harga' => $request->harga,
        ];

        DB::table('barang')
            ->where('idbarang', $id)
            ->where('status_aktif', 1)
            ->update($data);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    // Melakukan soft delete pada data
    public function softDelete($id)
    {
        DB::table('barang')
            ->where('idbarang', $id)
            ->update(['status_aktif' => 0]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus.');
    }
}
