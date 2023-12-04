<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeKasirController extends Controller
{
    public function index()
    {
        return view('pages.users.homekasir', [
            'title' => 'Home Kasir'
        ]);
    }
}
