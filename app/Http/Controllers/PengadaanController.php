<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    public function index()
    {
        // $users = DB::select('SELECT iduser, username FROM user WHERE idrole = ? AND status_aktif = ?', [1, 1]);
        // $vendors = DB::select('SELECT idvendor, nama_vendor FROM vendor WHERE status_aktif = ?', [1]);
        // $barangs = DB::select('SELECT idbarang, nama FROM barang WHERE status_aktif = ?', [1]);
        // $pengadaan = DB::select('SELECT p.*, u.username, v.nama_vendor
        //                         FROM pengadaan p
        //                         JOIN user u ON p.user_iduser = u.iduser
        //                         JOIN vendor v ON p.vendor_idvendor = v.idvendor
        //                         WHERE p.status_aktif = ?', [1]);

        $users = DB::select('SELECT iduser, username FROM users_pengadaan_view');
        $vendors = DB::select('SELECT idvendor, nama_vendor FROM vendors_pengadaan_view');
        $barangs = DB::select('SELECT idbarang, nama FROM barangs_pengadaan_view');
        $pengadaan = DB::select('SELECT * FROM pengadaan_view');

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

    // public function softDelete($idpengadaan)
    // {
    //     // Lakukan operasi penghapusan pengadaan berdasarkan ID
    //     DB::select('CALL hapus_pengadaan(?)', [$idpengadaan]);

    //     return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil dihapus');
    // }

    // public function getDeletedPengadaan()
    // {
    //     $deletedPengadaan = DB::table('v_pengadaan_deleted')->get();

    //     return response()->json($deletedPengadaan);
    // }

    // public function restorePengadaan($id)
    // {
    //     DB::select('CALL restore_pengadaan(?)', [$id]);

    //     return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil dipulihkan');
    // }

    public function indexDetail($idpengadaan)
    {
        // Query raw untuk mendapatkan data pengadaan berdasarkan idpengadaan
        $detailPengadaan = DB::select("SELECT p.*, u.username, v.nama_vendor
                                    FROM pengadaan p
                                    JOIN user u ON p.user_iduser = u.iduser
                                    JOIN vendor v ON p.vendor_idvendor = v.idvendor
                                    WHERE p.idpengadaan = :idpengadaan
                                    LIMIT 1", ['idpengadaan' => $idpengadaan]);

        // Query raw untuk mendapatkan detail barang berdasarkan idpengadaan
        $detailBarang = DB::select("SELECT dp.iddetail_pengadaan, b.nama as nama_barang, dp.jumlah, dp.harga_satuan, dp.sub_total
                                    FROM detail_pengadaan dp
                                    JOIN barang b ON dp.idbarang = b.idbarang
                                    WHERE dp.idpengadaan = :idpengadaan", ['idpengadaan' => $idpengadaan]);

        // Mengambil data pertama dari hasil query
        $detailPengadaan = count($detailPengadaan) > 0 ? $detailPengadaan[0] : null;

        // Query raw untuk mendapatkan daftar barang (contoh, sesuaikan dengan struktur tabel dan kolom)
        $barangs = DB::select("SELECT idbarang, nama
                            FROM barang");

        return view('pages.admins.detail_pengadaan', [
            'title' => 'Detail Pengadaan Barang',
            'detailPengadaan' => $detailPengadaan,
            'detailBarang' => $detailBarang,
            'barangs' => $barangs,
        ]);
    }

    public function storeDetail(Request $request)
    {
        // Validasi input
        $request->validate([
            'idBarang' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'hargaSatuan' => 'required|integer|min:1',
            'idPengadaan' => 'required|integer|min:1',
        ]);

        // Ambil data dari request
        $idBarang = $request->input('idBarang');
        $jumlah = $request->input('jumlah');
        $hargaSatuan = $request->input('hargaSatuan');
        $idPengadaan = $request->input('idPengadaan');

        // Panggil stored procedure untuk tambah barang pengadaan
        DB::select('CALL tambah_barang_pengadaan(?, ?, ?, ?)', [
            $hargaSatuan, $jumlah, $idBarang, $idPengadaan
        ]);

        // Redirect atau berikan respons sesuai kebutuhan aplikasi
        return redirect()->back()->with('success', 'Detail pengadaan berhasil ditambahkan.');
    }
}
