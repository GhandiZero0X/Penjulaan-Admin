<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::select('SELECT u.*, r.nama_role
                            FROM USER u
                            JOIN role r ON u.idrole = r.idrole
                            WHERE u.status_aktif = ?', [1]);

        $roles = DB::select('SELECT *
                            FROM role
                            WHERE status_aktif = ?', [1]);

        return view('pages.admins.user', [
            'users' => $users,
            'roles' => $roles,
            'title' => 'Users'
        ]);
    }

    public function create(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $idrole = $request->input('idrole');

        // Pastikan bahwa password di-hash sebelum disimpan
        $hashedPassword = bcrypt($password);

        // Periksa apakah user dengan username yang sama sudah ada
        $existingUser = DB::select('SELECT *
                                    FROM user
                                    WHERE username = ? LIMIT 1', [$username]);

        if (!empty($existingUser)) {
            return response()->json(['error' => 'User dengan username yang sama sudah ada.']);
        }

        // Insert data ke dalam tabel "user" dengan menggunakan SQL native
        $newUser = DB::insert('INSERT INTO user (username, password, idrole, status_aktif)
                            VALUES (?, ?, ?, 1)', [$username, $hashedPassword, $idrole]);

        if ($newUser) {
            // Ambil data user yang baru saja dibuat
            $userData = DB::select('SELECT *
                                    FROM user
                                    WHERE username = ? LIMIT 1', [$username]);

            if (!empty($userData)) {
                return response()->json($userData[0]);
            } else {
                return response()->json(['error' => 'Gagal menambahkan user.']);
            }
        } else {
            return response()->json(['error' => 'Gagal menambahkan user.']);
        }
    }

    public function update(Request $request, $iduser)
    {
        // Validasi input dari form
        $request->validate([
            'edit_username' => 'required',
            'edit_idrole' => 'required'
        ]);

        $username = $request->input('edit_username');
        $idrole = $request->input('edit_idrole');

        // Ambil data peran (roles) dari database
        $roles = DB::select('SELECT * FROM role WHERE status_aktif = ?', [1]);

        // Perbarui data dalam tabel "USER" menggunakan query native
        $query = "UPDATE USER
            SET username = :username, idrole = :idrole
            WHERE iduser = :iduser AND status_aktif = 1";

        $bindings = [
            'username' => $username,
            'idrole' => $idrole,
            'iduser' => $iduser,
        ];

        $affectedRows = DB::update($query, $bindings);

        if ($affectedRows > 0) {
            // Jika pembaruan berhasil, dapatkan data yang diperbarui
            $user = DB::select('SELECT USER.iduser, USER.username, role.nama_role
                            FROM USER
                            JOIN role ON USER.idrole = role.idrole
                            WHERE USER.iduser = ? LIMIT 1', [$iduser]);

            if (!empty($user)) {
                return response()->json([
                    'iduser' => $user[0]->iduser,
                    'username' => $user[0]->username,
                    'nama_role' => $user[0]->nama_role,
                    'roles' => $roles, // Sertakan data peran di respons JSON
                ]);
            } else {
                return response()->json(['error' => 'Gagal memperbarui user. Silakan coba lagi.']);
            }
        } else {
            return response()->json(['error' => 'Gagal memperbarui user. Silakan coba lagi.']);
        }
    }



    public function softDelete($iduser)
    {
        // Perbarui status_aktif menjadi 0 (tidak aktif) untuk user dengan id tertentu menggunakan kueri langsung
        $affectedRows = DB::update('UPDATE USER
                                    SET status_aktif = 0
                                    WHERE iduser = ?', [$iduser]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'User berhasil dihapus']);
        } else {
            return response()->json(['error' => 'Gagal menghapus user']);
        }
    }

    public function getSoftDeletedUsers()
    {
        // Ambil data untuk user yang telah dihapus secara lunak (status_aktif = 0)
        $softDeletedUsers = DB::select('SELECT u.iduser, u.username, r.nama_role
                                    FROM user u
                                    JOIN role r ON u.idrole = r.idrole
                                    WHERE u.status_aktif = ?', [0]);
        return response()->json($softDeletedUsers);
    }

    public function restoreUser($id)
    {
        // Setel status_aktif user kembali menjadi 1 (aktif)
        $affectedRows = DB::update('UPDATE user
                                SET status_aktif = ?
                                WHERE iduser = ?', [1, $id]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'User berhasil dipulihkan.']);
        } else {
            return response()->json(['error' => 'Gagal memulihkan user.']);
        }
    }
}
