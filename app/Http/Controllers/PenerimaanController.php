<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function index()
    {
        return view('pages.admins.penerimaan', [
            'title' => 'Penerimaan Barang'
        ]);
    }
}
