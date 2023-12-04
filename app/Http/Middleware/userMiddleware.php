<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if (Auth::guard()->guest()) {
    //         return redirect()->route('index')->with('error', 'Anda harus login terlebih dahulu.');
    //     }

    //     $user = Auth::user();

    //     if (!$user || !$this->isMahasiswa($user)) {
    //         return redirect()->route('index')->with('error', 'Anda harus login terlebih dahulu.');
    //     }

    //     return $next($request);
    // }

    /**
     * Memeriksa apakah pengguna adalah user.
     *
     * @param  \App\Models\users  $user
     * @return bool
     */
    // private function isMahasiswa($user)
    // {
    //     $result = DB::select('SELECT * FROM user
    //                         WHERE iduser = ?', [$user->iduser]);
    //     return !empty($result);
    // }
}
