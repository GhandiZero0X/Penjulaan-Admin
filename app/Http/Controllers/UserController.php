<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        // $users = DB::select('SELECT u.*, r.nama_role
        //                     FROM user u
        //                     JOIN role r
        //                         ON u.idrole = r.idrole
        //                     WHERE u.status_aktif = ?', [1]);

        $users = DB::select('SELECT * FROM aktif_user_view');

        // $roles = DB::select('SELECT *
        //                     FROM role
        //                     WHERE status_aktif = ?', [1]);

        $roles = DB::select('SELECT * FROM aktif_role_view');

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

        $hashedPassword = bcrypt($password);

        $existingUser = DB::select('SELECT *
                                    FROM user
                                    WHERE username = ? LIMIT 1', [$username]);

        if (!empty($existingUser)) {
            return response()->json(['error' => 'User dengan username yang sama sudah ada.']);
        }

        $newUser = DB::insert('INSERT INTO user (username, password, idrole, status_aktif)
                            VALUES (?, ?, ?, 1)', [$username, $hashedPassword, $idrole]);

        if ($newUser) {
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

    // public function create(Request $request)
    // {
    //     $username = $request->input('username');
    //     $password = $request->input('password');
    //     $idrole = $request->input('idrole');

    //     $hashedPassword = bcrypt($password);

    //     $result = DB::select('CALL tambah_user(?, ?, ?)', [$username, $hashedPassword, $idrole]);

    //     if (!empty($result[0]->error)) {
    //         return response()->json(['error' => $result[0]->error]);
    //     }

    //     return response()->json($result[0]);
    // }


    public function update(Request $request, $iduser)
    {
        $request->validate([
            'edit_username' => 'required',
            'edit_idrole' => 'required'
        ]);

        $username = $request->input('edit_username');
        $idrole = $request->input('edit_idrole');

        $roles = DB::select('SELECT *
                            FROM role WHERE status_aktif = ?', [1]);

        $query = "UPDATE user
            SET username = :username, idrole = :idrole
            WHERE iduser = :iduser AND status_aktif = 1";

        $bindings = [
            'username' => $username,
            'idrole' => $idrole,
            'iduser' => $iduser,
        ];

        $affectedRows = DB::update($query, $bindings);

        if ($affectedRows > 0) {
            $user = DB::select('SELECT u.iduser, u.username, r.nama_role
                            FROM user u
                            JOIN role r
                                ON u.idrole = r.idrole
                            WHERE u.iduser = ? LIMIT 1', [$iduser]);

            if (!empty($user)) {
                return response()->json([
                    'iduser' => $user[0]->iduser,
                    'username' => $user[0]->username,
                    'nama_role' => $user[0]->nama_role,
                    'roles' => $roles,
                ]);
            } else {
                return response()->json(['error' => 'Gagal memperbarui user. Silakan coba lagi.']);
            }
        } else {
            return response()->json(['error' => 'Gagal memperbarui user. Silakan coba lagi.']);
        }
    }

    // public function update(Request $request, $iduser)
    // {
    //     $request->validate([
    //         'edit_username' => 'required',
    //         'edit_idrole' => 'required'
    //     ]);

    //     $username = $request->input('edit_username');
    //     $idrole = $request->input('edit_idrole');

    //     $roles = DB::table('aktif_role_view')->get();

    //     $affectedRows = DB::select('CALL update_user(?, ?, ?)', [$iduser, $username, $idrole]);

    //     if ($affectedRows) {
    //         $user = DB::table('aktif_user_view')->where('iduser', $iduser)->first();

    //         if ($user) {
    //             return response()->json([
    //                 'iduser' => $user->iduser,
    //                 'username' => $user->username,
    //                 'nama_role' => $user->nama_role,
    //                 'roles' => $roles,
    //             ]);
    //         } else {
    //             return response()->json(['error' => 'Gagal memperbarui user. Silakan coba lagi.']);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Gagal memperbarui user. Silakan coba lagi.']);
    //     }
    // }

    public function softDelete($iduser)
    {
        $affectedRows = DB::update('UPDATE user
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
        $softDeletedUsers = DB::select('SELECT u.iduser, u.username, r.nama_role
                                    FROM user u
                                    JOIN role r
                                        ON u.idrole = r.idrole
                                    WHERE u.status_aktif = ?', [0]);
        return response()->json($softDeletedUsers);
    }

    public function restoreUser($id)
    {
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
