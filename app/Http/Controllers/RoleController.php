<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // Create (Insert) Data
    public function create(Request $request)
    {
        $namaRole = $request->input('nama_role');

        // Insert data ke tabel "role"
        DB::table('role')->insert([
            'nama_role' => $namaRole,
        ]);

        return redirect('/roles')->with('success', 'Data berhasil ditambahkan.');
    }

    // Read (Select) Data
    public function read()
    {
        // Mengambil data dari tabel "role" yang memiliki status_aktif 1
        $roles = DB::table('role')->where('status_aktif', 1)->get();

        return view('roles.index', ['roles' => $roles]);
    }

    // Update Data
    public function update(Request $request, $idrole)
    {
        $namaRole = $request->input('nama_role');

        // Update data di tabel "role"
        DB::table('role')
            ->where('idrole', $idrole)
            ->update([
                'nama_role' => $namaRole,
            ]);

        return redirect('/roles')->with('success', 'Data berhasil diperbarui.');
    }

    // Soft Delete (Update status_aktif)
    public function softDelete($idrole)
    {
        // Update status_aktif menjadi 0 (non-aktif) pada data dengan idrole tertentu
        DB::table('role')
            ->where('idrole', $idrole)
            ->update(['status_aktif' => 0]);

        return redirect('/roles')->with('success', 'Data berhasil dihapus (soft delete).');
    }
}
