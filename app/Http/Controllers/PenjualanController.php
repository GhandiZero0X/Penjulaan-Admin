<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    public function index()
    {
        // Assuming you have 'penjualans', 'users', 'barangs', and 'margin_penjualans' tables
        $penjualan = DB::select("SELECT
                                    p.idpenjualan,
                                    u.username AS nama_user,
                                    mp.persen AS margin_penjualan,
                                    p.created_at AS tanggal,
                                    p.subtotal_nilai,
                                    p.ppn,
                                    p.total_nilai,
                                    p.status_aktif
                                FROM penjualan p
                                JOIN user u ON p.iduser = u.iduser
                                JOIN margin_penjualan mp ON p.idmargin_penjualan = mp.idmargin_penjualan");

        return view('pages.users.penjualan', [
            'title' => 'Penjualan Barang',
            'penjualan' => $penjualan,
        ]);
    }
}
