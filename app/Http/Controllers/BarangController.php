<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barang = DB::select('SELECT b.*, s.nama_satuan
                            FROM barang b
                            JOIN satuan s ON b.idsatuan = s.idsatuan
                            WHERE b.status_aktif = ?', [1]);

        $satuan = DB::select('SELECT *
                            FROM satuan
                            WHERE status_aktif = ?', [1]);

        return view('pages.admins.barang', [
            'barang' => $barang,
            'satuan' => $satuan,
            'title' => 'Barang'
        ]);
    }

    public function create(Request $request)
    {
        $jenis = $request->input('jenis');
        $nama = $request->input('nama');
        $idsatuan = $request->input('idsatuan');
        $harga = $request->input('harga');

        // Insert data ke dalam tabel "barang" dengan menggunakan SQL native
        $newBarang = DB::insert('INSERT INTO barang (jenis, nama, idsatuan, harga, status_aktif)
                                VALUES (?, ?, ?, ?, 1)', [$jenis, $nama, $idsatuan, $harga]);

        if ($newBarang) {
            // Ambil data barang yang baru saja dibuat
            $barangData = DB::select('SELECT *
                                    FROM barang
                                    WHERE nama = ? LIMIT 1', [$nama]);

            if (!empty($barangData)) {
                return response()->json($barangData[0]);
            } else {
                return response()->json(['error' => 'Gagal menambahkan barang.']);
            }
        } else {
            return response()->json(['error' => 'Gagal menambahkan barang.']);
        }
    }

    public function update(Request $request, $idbarang)
    {
        // Validasi input dari form
        $request->validate([
            'edit_jenis' => 'required',
            'edit_nama' => 'required',
            'edit_idsatuan' => 'required',
            'edit_harga' => 'required'
        ]);

        $jenis = $request->input('edit_jenis');
        $nama = $request->input('edit_nama');
        $idsatuan = $request->input('edit_idsatuan');
        $harga = $request->input('edit_harga');

        // Perbarui data dalam tabel "barang" menggunakan query native
        $query = "UPDATE barang
                SET jenis = :jenis, nama = :nama, idsatuan = :idsatuan, harga = :harga
                WHERE idbarang = :idbarang AND status_aktif = 1";

        $bindings = [
            'jenis' => $jenis,
            'nama' => $nama,
            'idsatuan' => $idsatuan,
            'harga' => $harga,
            'idbarang' => $idbarang,
        ];

        $affectedRows = DB::update($query, $bindings);

        if ($affectedRows > 0) {
            // Jika pembaruan berhasil, dapatkan data yang diperbarui
            $barang = DB::select('SELECT b.idbarang, b.jenis, b.nama, s.nama_satuan
                            FROM barang b
                            JOIN satuan s ON b.idsatuan = s.idsatuan
                            WHERE b.idbarang = ? LIMIT 1', [$idbarang]);

            if (!empty($barang)) {
                return response()->json([
                    'idbarang' => $barang[0]->idbarang,
                    'jenis' => $barang[0]->jenis,
                    'nama' => $barang[0]->nama,
                    'nama_satuan' => $barang[0]->nama_satuan,
                ]);
            } else {
                return response()->json(['error' => 'Gagal memperbarui barang. Silakan coba lagi.']);
            }
        } else {
            return response()->json(['error' => 'Gagal memperbarui barang. Silakan coba lagi.']);
        }
    }

    public function softDelete($idbarang)
    {
        // Perbarui status_aktif menjadi 0 (tidak aktif) untuk barang dengan id tertentu menggunakan kueri langsung
        $affectedRows = DB::update('UPDATE barang
                                    SET status_aktif = 0
                                    WHERE idbarang = ?', [$idbarang]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Barang berhasil dihapus']);
        } else {
            return response()->json(['error' => 'Gagal menghapus barang']);
        }
    }

    public function getSoftDeletedBarang()
    {
        // Ambil data untuk barang yang telah dihapus secara lunak (status_aktif = 0)
        $softDeletedBarang = DB::select('SELECT b.idbarang, b.jenis, b.nama, s.nama_satuan
                                    FROM barang b
                                    JOIN satuan s ON b.idsatuan = s.idsatuan
                                    WHERE b.status_aktif = ?', [0]);
        return response()->json($softDeletedBarang);
    }

    public function restoreBarang($id)
    {
        // Setel status_aktif barang kembali menjadi 1 (aktif)
        $affectedRows = DB::update('UPDATE barang
                                SET status_aktif = ?
                                WHERE idbarang = ?', [1, $id]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Barang berhasil dipulihkan.']);
        } else {
            return response()->json(['error' => 'Gagal memulihkan barang.']);
        }
    }
}
