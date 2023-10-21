<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function index()
    {
        // Membaca data satuan yang memiliki status_aktif 1 (aktif)
        $satuan = DB::table('satuan')->where('status_aktif', 1)->get();
        return view('satuan.index', ['satuan' => $satuan]);
    }

    public function create()
    {
        // Menampilkan form untuk membuat data satuan baru
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        // Menyimpan data satuan baru ke dalam database
        DB::table('satuan')->insert([
            'nama_satuan' => $request->nama_satuan,
            'status_aktif' => 1, // Data baru selalu aktif
        ]);

        return redirect('/satuan')->with('success', 'Data satuan berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Menampilkan form untuk mengedit data satuan
        $satuan = DB::table('satuan')->where('idsatuan', $id)->first();
        return view('satuan.edit', ['satuan' => $satuan]);
    }

    public function update(Request $request, $id)
    {
        // Mengupdate data satuan
        DB::table('satuan')->where('idsatuan', $id)->update([
            'nama_satuan' => $request->nama_satuan,
        ]);

        return redirect('/satuan')->with('success', 'Data satuan berhasil diperbarui');
    }

    public function softDelete($id)
    {
        // Melakukan soft delete (mengubah status_aktif menjadi 0)
        DB::table('satuan')->where('idsatuan', $id)->update([
            'status_aktif' => 0,
        ]);

        return redirect('/satuan')->with('success', 'Data satuan berhasil dihapus (soft delete)');
    }
}
