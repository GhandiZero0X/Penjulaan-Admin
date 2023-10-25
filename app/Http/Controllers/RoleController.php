<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleController extends Controller
{
    public function index()
    {
        // query builder untuk menampilkan data
        // $roles = DB::table('role')
        //         ->select('nama_role', 'status_aktif')
        //         ->where('status_aktif', 1)
        //         ->get();

        // Query Native
        $roles = DB::select('SELECT *
                            FROM role
                            WHERE status_aktif = ?', [1]);
        return view('pages.admins.role', [
            'roles' => $roles,
            'title' => 'Role'
        ]);
    }

    public function create(Request $request)
    {
        // $namaRole = $request->input('nama_role');

        // // Cek apakah peran dengan nama yang sama sudah ada
        // $existingRole = DB::table('role')->where('nama_role', $namaRole)->first();

        // if ($existingRole) {
        //     return response()->json(['error' => 'Peran dengan nama yang sama sudah ada.']);
        // }

        // // Insert data ke tabel "role"
        // $newRole = DB::table('role')->insert([
        //     'nama_role' => $namaRole,
        //     'status_aktif' => 1,
        // ]);

        // if ($newRole) {
        //     // Mengambil data role yang baru saja dibuat
        //     $roleData = DB::table('role')->where('nama_role', $namaRole)->first();

        //     return response()->json($roleData);
        // } else {
        //     return response()->json(['error' => 'Gagal menambahkan role.']);
        // }

        $namaRole = $request->input('nama_role');

        // Cek apakah peran dengan nama yang sama sudah ada
        $existingRole = DB::select('SELECT *
                                    FROM role
                                    WHERE nama_role = ? LIMIT 1', [$namaRole]);

        if (!empty($existingRole)) {
            return response()->json(['error' => 'Peran dengan nama yang sama sudah ada.']);
        }

        // Insert data ke tabel "role"
        $newRole = DB::insert('INSERT INTO role (nama_role, status_aktif)
                                VALUES (?, 1)', [$namaRole]);

        if ($newRole) {
            // Mengambil data role yang baru saja dibuat
            $roleData = DB::select('SELECT *
                                    FROM role
                                    WHERE nama_role = ? LIMIT 1', [$namaRole]);

            if (!empty($roleData)) {
                return response()->json($roleData[0]);
            } else {
                return response()->json(['error' => 'Gagal menambahkan role.']);
            }
        } else {
            return response()->json(['error' => 'Gagal menambahkan role.']);
        }
    }

    public function update(Request $request, $idrole)
    {
        // $namaRole = $request->input('edit_nama_role'); // Use 'edit_nama_role' field name

        // // Update data in the "role" table
        // $affectedRows = DB::table('role')
        //     ->where('idrole', $idrole)
        //     ->update([
        //         'nama_role' => $namaRole,
        //     ]);

        // if ($affectedRows > 0) {
        //     // If the update was successful
        //     $roleData = DB::table('role')->where('idrole', $idrole)->first();
        //     return response()->json($roleData);
        // } else {
        //     // If the update failed
        //     return response()->json(['error' => 'Gagal memperbarui role. Silakan coba lagi.']);
        // }

        $namaRole = $request->input('edit_nama_role');

        // Update data in the "role" table using a raw query
        $affectedRows = DB::update('UPDATE role
                                    SET nama_role = ?
                                    WHERE idrole = ? AND status_aktif = 1', [$namaRole, $idrole]);

        if ($affectedRows > 0) {
            // If the update was successful
            $roleData = DB::select('SELECT *
                                    FROM role
                                    WHERE idrole = ? LIMIT 1', [$idrole]);

            if (!empty($roleData)) {
                return response()->json($roleData[0]);
            } else {
                return response()->json(['error' => 'Gagal memperbarui role. Silakan coba lagi.']);
            }
        } else {
            return response()->json(['error' => 'Gagal memperbarui role. Silakan coba lagi.']);
        }
    }

    public function softDelete($idrole)
    {
        // Update status_aktif menjadi 0 (non-aktif) pada data dengan idrole tertentu menggunakan raw query
        $affectedRows = DB::update('UPDATE role
                                    SET status_aktif = 0
                                    WHERE idrole = ?', [$idrole]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Role berhasil dihapus']);
        } else {
            return response()->json(['error' => 'Gagal menghapus role']);
        }
    }

    public function getSoftDeletedRoles()
    {
        // Mengambil data role yang dihapus secara lunak (status_aktif = 0)
        // $softDeletedRoles = DB::table('role')
        //     ->where('status_aktif', 0)->get();

        // return response()->json($softDeletedRoles);

        // Mengambil data role yang dihapus secara lunak (status_aktif = 0)
        $softDeletedRoles = DB::select('SELECT *
                                        FROM role
                                        WHERE status_aktif = ?', [0]);
        return response()->json($softDeletedRoles);
    }

    public function restoreRole($id)
    {
        // Mengembalikan status_aktif role ke 1 (aktif)
        // $affectedRows = DB::table('role')
        //     ->where('idrole', $id)
        //     ->update(['status_aktif' => 1]);
        // if ($affectedRows > 0) {
        //     return response()->json(['message' => 'Role berhasil dipulihkan.']);
        // } else {
        //     return response()->json(['error' => 'Gagal memulihkan role.']);
        // }

        // Mengembalikan status_aktif role ke 1 (aktif)
        $affectedRows = DB::update('UPDATE role
                                    SET status_aktif = ?
                                    WHERE idrole = ?', [1, $id]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Role berhasil dipulihkan.']);
        } else {
            return response()->json(['error' => 'Gagal memulihkan role.']);
        }
    }
}
