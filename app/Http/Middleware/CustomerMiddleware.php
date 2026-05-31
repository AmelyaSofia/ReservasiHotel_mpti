<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Tangani request masuk — hanya izinkan pengguna dengan role customer.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isCustomer()) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk pelanggan.');
        }

        return $next($request);
    }
}
