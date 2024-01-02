<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    public function index()
    {
        $users = DB::select('SELECT iduser, username FROM user WHERE idrole = ? AND status_aktif = ?', [1, 1]);
        $vendors = DB::select('SELECT idvendor, nama_vendor FROM vendor WHERE status_aktif = ?', [1]);
        $barangs = DB::select('SELECT idbarang, nama FROM barang WHERE status_aktif = ?', [1]);
        $pengadaan = DB::select('SELECT p.*, u.username, v.nama_vendor
                                FROM pengadaan p
                                JOIN user u ON p.user_iduser = u.iduser
                                JOIN vendor v ON p.vendor_idvendor = v.idvendor
                                WHERE p.status_aktif = ?', [1]);

        return view('pages.admins.pengadaan', [
            'title' => 'Daftar Pengadaan Barang',
            'pengadaan' => $pengadaan,
            'users' => $users,
            'vendors' => $vendors,
            'barangs' => $barangs,
        ]);
    }

    public function store(Request $request)
    {
        $idUser = $request->input('idUser');
        $idVendor = $request->input('idVendor');
        $namaBarang = $request->input('namaBarang');
        $jumlah = $request->input('jumlah');
        $harga = $request->input('harga');
        $ppn = $request->input('ppn');

        // Panggil stored procedure untuk membuat pengadaan
        DB::select('CALL pengadaan_barang(?, ?, ?, ?, ?, ?)', [
            $idUser, $idVendor, $namaBarang, $jumlah, $harga, $ppn
        ]);

        return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil ditambahkan');
    }

    public function softDelete($idpengadaan)
    {
        // Lakukan operasi penghapusan pengadaan berdasarkan ID
        DB::select('CALL hapus_pengadaan(?)', [$idpengadaan]);

        return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil dihapus');
    }

    public function getDeletedPengadaan()
    {
        $deletedPengadaan = DB::table('v_pengadaan_deleted')->get();

        return response()->json($deletedPengadaan);
    }

    public function restorePengadaan($id)
    {
        DB::select('CALL restore_pengadaan(?)', [$id]);

        return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil dipulihkan');
    }
}
