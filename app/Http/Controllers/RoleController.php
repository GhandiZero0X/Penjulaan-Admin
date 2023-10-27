<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleController extends Controller
{
    public function index()
    {
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
        $namaRole = $request->input('nama_role');

        $existingRole = DB::select('SELECT *
                                    FROM role
                                    WHERE nama_role = ? LIMIT 1', [$namaRole]);

        if (!empty($existingRole)) {
            return response()->json(['error' => 'Peran dengan nama yang sama sudah ada.']);
        }

        $newRole = DB::insert('INSERT INTO role (nama_role, status_aktif)
                                VALUES (?, 1)', [$namaRole]);

        if ($newRole) {
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
        $namaRole = $request->input('edit_nama_role');

        $affectedRows = DB::update('UPDATE role
                                    SET nama_role = ?
                                    WHERE idrole = ? AND status_aktif = 1', [$namaRole, $idrole]);

        if ($affectedRows > 0) {
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
        $softDeletedRoles = DB::select('SELECT *
                                        FROM role
                                        WHERE status_aktif = ?', [0]);
        return response()->json($softDeletedRoles);
    }

    public function restoreRole($id)
    {
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
