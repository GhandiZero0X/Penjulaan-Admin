<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function index()
    {
        // Fetch data from the database using a raw SQL query
        $penerimaan = DB::select('SELECT p.idpenerimaan, p.created_at as timestamp, u.username, p.status_aktif
                                FROM penerimaan p
                                JOIN user u ON p.iduser = u.iduser');

        // Fetch pengadaan that haven't been received
        $pengadaan = DB::select('SELECT pa.idpengadaan, pa.timestamp, u.username, v.idvendor,v.nama_vendor, pa.subtotal_nilai, pa.ppn, pa.total_nilai, pa.status_aktif
                                FROM pengadaan pa
                                JOIN user u ON pa.user_iduser = u.iduser
                                JOIN vendor v ON pa.vendor_idvendor = v.idvendor
                                LEFT JOIN penerimaan pe ON pa.idpengadaan = pe.idpengadaan
                                WHERE pe.idpengadaan IS NULL');

        return view('pages.admins.penerimaan', [
            'title' => 'Penerimaan Barang',
            'penerimaan' => $penerimaan,
            'pengadaan' => $pengadaan,
        ]);
    }

    public function store(Request $request)
    {
        $idUser = $request->input('idUser');
        $idPengadaan = $request->input('idPengadaan');

        // Call the penerimaan_barang stored procedure
        DB::select("CALL penerimaan_barang($idUser, $idPengadaan)");

        // You can return a response if needed
        return redirect()->route('penerimaan.index')->with('success', 'Barang diterima.');
    }
}
