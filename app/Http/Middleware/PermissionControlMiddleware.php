<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissionControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$permissions)
    {

        if (!Auth::check()) {
            return redirect()->route('login'); // Kullanıcı giriş yapmamışsa giriş sayfasına yönlendir
        }

        $user = Auth::user();
        $hasAccess = false;

        // Kullanıcının doğrudan izinlerini al
        $userPermissions = $user->permissions->pluck('name')->toArray();

        // Kullanıcının rollerinden izinleri al
        $rolePermissions = Role::whereIn('name', $user->getRoleNames())
            ->with('permissions') // Rollerin izinlerini getir
            ->get()
            ->pluck('permissions.*.name')
            ->flatten()
            ->toArray();

        // İzinlerin kontrolü
        foreach ($permissions as $permission) {
            if (in_array($permission, $userPermissions) || in_array($permission, $rolePermissions)) {
                $hasAccess = true; // İzin bulundu, erişim sağla
                break; // Döngüyü sonlandır
            }
        }

        // Erişim izni yoksa hata döndür
        if (!$hasAccess) {
            abort(403); // 403 Forbidden hatası
        }

        return $next($request); // Erişim izni varsa istenen işlemi gerçekleştir
    }
}
