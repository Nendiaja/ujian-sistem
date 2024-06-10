<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna memiliki peran admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            // Menampilkan pesan SweetAlert
            Alert::error('Error', 'Anda tidak memiliki izin untuk mengakses halaman ini.')->persistent(true);
            
            // Redirect ke halaman lain
            return redirect()->back();
        }

        // Jika pengguna adalah admin, lanjutkan ke rute yang diminta
        return $next($request);
    }
}