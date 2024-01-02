<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('pages.users.penjualan', [
            'title' => 'Penjualan Barang'
        ]);
    }
}
