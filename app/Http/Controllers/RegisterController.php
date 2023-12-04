<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.auth.register', [
            'title' => 'Register'
        ]);
    }

    public function submitRegis(Request $request)
    {
        $username = $request->input('username');
        $password = bcrypt($request->input('password'));
        $idRole = 2;

        DB::insert('INSERT INTO user (username, password, idrole)
                    VALUES (?, ?, ?)', [$username, $password, $idRole]);

        return redirect()->route('login.user')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
