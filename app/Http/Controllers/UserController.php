<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = DB::table('user')
            ->where('status_aktif', 1) // Hanya menampilkan data yang status_aktif nya 1 (aktif)
            ->get();

        return view('pages.admins.user', compact('users'));
    }

    // Menampilkan form tambah pengguna
    public function create()
    {
        return view('user.create');
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi input jika diperlukan

        DB::table('user')->insert([
            'username' => $request->username,
            'PASSWORD' => Hash::make($request->PASSWORD),
            'idrole' => $request->idrole,
            'status_aktif' => 1, // Pengguna baru secara default aktif
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $user = DB::table('user')->find($id);

        return view('user.edit', compact('user'));
    }

    // Mengupdate pengguna di database
    public function update(Request $request, $id)
    {
        // Validasi input jika diperlukan

        DB::table('user')
            ->where('iduser', $id)
            ->update([
                'username' => $request->username,
                'idrole' => $request->idrole,
            ]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Soft delete pengguna
    public function softDelete($id)
    {
        DB::table('user')
            ->where('iduser', $id)
            ->update(['status_aktif' => 0]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    // Fungsi otentikasi untuk login
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = DB::table('user')
            ->where('username', $username)
            ->where('status_aktif', 1) // Hanya login jika status_aktif nya 1 (aktif)
            ->first();

        if ($user && Hash::check($password, $user->PASSWORD)) {
            // Login sukses
            return redirect()->route('dashboard')->with('success', 'Login berhasil.');
        } else {
            // Login gagal
            return redirect()->route('login')->with('error', 'Login gagal. Periksa username dan password Anda.');
        }
    }
}
