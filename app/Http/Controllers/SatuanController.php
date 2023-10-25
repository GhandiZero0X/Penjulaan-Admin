<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function index()
    {
        // Query native untuk menampilkan data
        $satuans = DB::select('SELECT *
                            FROM satuan
                            WHERE status_aktif = ?', [1]);
        return view('pages.admins.satuan', [
            'satuans' => $satuans,
            'title' => 'Satuan'
        ]);
    }

    public function create(Request $request)
    {
        $namaSatuan = $request->input('nama_satuan');

        // Cek apakah satuan dengan nama yang sama sudah ada
        $existingSatuan = DB::select('SELECT *
                                    FROM satuan
                                    WHERE nama_satuan = ? LIMIT 1', [$namaSatuan]);

        if (!empty($existingSatuan)) {
            return response()->json(['error' => 'Satuan dengan nama yang sama sudah ada.']);
        }

        // Insert data ke tabel "satuan"
        $newSatuan = DB::insert('INSERT INTO satuan (nama_satuan, status_aktif)
                                VALUES (?, 1)', [$namaSatuan]);

        if ($newSatuan) {
            // Mengambil data satuan yang baru saja dibuat
            $satuanData = DB::select('SELECT *
                                    FROM satuan
                                    WHERE nama_satuan = ? LIMIT 1', [$namaSatuan]);

            if (!empty($satuanData)) {
                return response()->json($satuanData[0]);
            } else {
                return response()->json(['error' => 'Gagal menambahkan satuan.']);
            }
        } else {
            return response()->json(['error' => 'Gagal menambahkan satuan.']);
        }
    }

    public function update(Request $request, $idsatuan)
    {
        $namaSatuan = $request->input('edit_nama_satuan');

        // Update data in the "satuan" table using a raw query
        $affectedRows = DB::update('UPDATE satuan
                                    SET nama_satuan = ?
                                    WHERE idsatuan = ? AND status_aktif = 1', [$namaSatuan, $idsatuan]);

        if ($affectedRows > 0) {
            // If the update was successful
            $satuanData = DB::select('SELECT *
                                    FROM satuan
                                    WHERE idsatuan = ? LIMIT 1', [$idsatuan]);

            if (!empty($satuanData)) {
                return response()->json($satuanData[0]);
            } else {
                return response()->json(['error' => 'Gagal memperbarui satuan. Silakan coba lagi.']);
            }
        } else {
            return response()->json(['error' => 'Gagal memperbarui satuan. Silakan coba lagi.']);
        }
    }

    public function softDelete($idsatuan)
    {
        // Update status_aktif menjadi 0 (non-aktif) pada data dengan idsatuan tertentu menggunakan raw query
        $affectedRows = DB::update('UPDATE satuan
                                    SET status_aktif = 0
                                    WHERE idsatuan = ?', [$idsatuan]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Satuan berhasil dihapus']);
        } else {
            return response()->json(['error' => 'Gagal menghapus satuan']);
        }
    }

    public function getSoftDeletedSatuans()
    {
        // Mengambil data satuan yang dihapus secara lunak (status_aktif = 0)
        $softDeletedSatuans = DB::select('SELECT *
                                        FROM satuan
                                        WHERE status_aktif = ?', [0]);
        return response()->json($softDeletedSatuans);
    }

    public function restoreSatuan($id)
    {
        // Mengembalikan status_aktif satuan ke 1 (aktif)
        $affectedRows = DB::update('UPDATE satuan
                                    SET status_aktif = ?
                                    WHERE idsatuan = ?', [1, $id]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Satuan berhasil dipulihkan.']);
        } else {
            return response()->json(['error' => 'Gagal memulihkan satuan.']);
        }
    }
}
