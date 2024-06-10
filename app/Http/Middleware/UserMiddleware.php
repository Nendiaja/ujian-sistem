<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna tidak memiliki izin
        if (!auth()->check() || !auth()->user()->isUser()) {
            // Tampilkan pesan SweetAlert
            Alert::error('Error', 'Anda tidak memiliki izin untuk mengakses halaman ini.')->persistent(true);
            
            // Redirect ke halaman lain
            return redirect()->back();
        }

        // Jika pengguna adalah pengguna biasa, lanjutkan ke rute yang diminta
        return $next($request);
    }
}
