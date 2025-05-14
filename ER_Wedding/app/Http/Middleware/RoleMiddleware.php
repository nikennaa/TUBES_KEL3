<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        //Cek jika user tidak login atau tidak memiliki role yang sesuai
        if (!$user || !in_array($user->role, $roles)) {
            // Jika tidak memiliki akses, redirect ke halaman utama dengan pesan error
            session()->flash('error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('Home');
        }

        return $next($request);
    }
}
