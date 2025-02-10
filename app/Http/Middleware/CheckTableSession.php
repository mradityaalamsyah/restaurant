<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTableSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session table_id ada
        if (!session()->has('table_id')) {
            // Redirect ke halaman error atau minta scan ulang
            return redirect()->route('error')->with('error', 'ID Meja tidak ditemukan, silakan scan ulang QR Code.');
        }

        return $next($request);
    }
}
