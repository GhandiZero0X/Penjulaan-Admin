<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HomeKasirController extends Controller
{
    public function index()
    {
        return view('pages.users.homekasir', [
            'title' => 'Home Kasir'
        ]);
    }

    public function cariBarang(Request $request)
    {
        $barang = $request->barang;

        // $result = DB::table('barang')
        //     ->where(DB::raw("upper(nama)"), 'LIKE', DB::raw("upper('%$barang%')"))
        //     ->get();

        $result = DB::table('barang')
            ->whereRaw("upper(nama) LIKE upper('%$barang%')")
            ->get()
            ->toArray();
        //     ->toSql();

        // echo $result;
        // die;


        return response()->json($result);
    }
}
