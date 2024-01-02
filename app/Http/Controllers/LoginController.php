<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login', [
            'title' => 'Login'
        ]);
    }

    public function submitLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = DB::select("SELECT idrole, password
                        FROM user
                        WHERE username = ? LIMIT 1", [$username]);

        if (!empty($user) && isset($user[0]->password) && password_verify($password, $user[0]->password)) {
            // Jika login berhasil
            if ($user[0]->idrole == 1) {
                return redirect()->route('dashboard');
            } elseif ($user[0]->idrole == 2) {
                return redirect()->route('penjualan.Kasir');
            }
        }

        return redirect()->route('login.user')->with('error', 'Login failed. Please check your credentials.');
    }
}
