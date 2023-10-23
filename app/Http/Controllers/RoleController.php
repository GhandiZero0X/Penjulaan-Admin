<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleController extends Controller
{
    public function index()
    {
        // Mengambil data dari tabel "role" yang memiliki status_aktif 1
        $roles = DB::table('role')->where('status_aktif', 1)->get();

        return view('pages.admins.role', ['roles' => $roles]);
    }

    public function create(Request $request)
    {
        $namaRole = $request->input('nama_role');

        // Cek apakah peran dengan nama yang sama sudah ada
        $existingRole = DB::table('role')->where('nama_role', $namaRole)->first();

        if ($existingRole) {
            return response()->json(['error' => 'Peran dengan nama yang sama sudah ada.']);
        }

        // Insert data ke tabel "role"
        $newRole = DB::table('role')->insert([
            'nama_role' => $namaRole,
            'status_aktif' => 1,
        ]);

        if ($newRole) {
            // Mengambil data role yang baru saja dibuat
            $roleData = DB::table('role')->where('nama_role', $namaRole)->first();

            return response()->json($roleData);
        } else {
            return response()->json(['error' => 'Gagal menambahkan role.']);
        }
    }


    // Update Data
    public function update(Request $request, $idrole)
    {
        $namaRole = $request->input('edit_nama_role'); // Use 'edit_nama_role' field name

        // Update data in the "role" table
        $affectedRows = DB::table('role')
            ->where('idrole', $idrole)
            ->update([
                'nama_role' => $namaRole,
            ]);

        if ($affectedRows > 0) {
            // If the update was successful
            $roleData = DB::table('role')->where('idrole', $idrole)->first();
            return response()->json($roleData);
        } else {
            // If the update failed
            return response()->json(['error' => 'Gagal memperbarui role. Silakan coba lagi.']);
        }
    }


    // Soft Delete (Update status_aktif)
    public function softDelete($idrole)
    {
        // Update status_aktif menjadi 0 (non-aktif) pada data dengan idrole tertentu
        $affectedRows = DB::table('role')
            ->where('idrole', $idrole)
            ->update(['status_aktif' => 0]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Role berhasil dihapus (soft delete).']);
        } else {
            return response()->json(['error' => 'Gagal menghapus role.']);
        }
    }
}
