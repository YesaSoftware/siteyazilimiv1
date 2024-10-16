<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Symfony\Component\HttpFoundation\Response;

class RoleOrPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle($request, Closure $next, ...$rolesAndPermissions)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $hasAccess = false;

        // Kullanıcının rollerini al
        $userRoles = $user->getRoleNames()->toArray();
        // Kullanıcının izinlerini al
        $userPermissions = $user->permissions->pluck('name')->toArray();
        // Rollerin izinlerini al
        $rolePermissions = Role::whereIn('name', $userRoles)
            ->with('permissions')
            ->get()
            ->pluck('permissions.*.name')
            ->flatten()
            ->toArray();

        // Rolleri ve izinleri kontrol et
        foreach ($rolesAndPermissions as $item) {
            if (str_starts_with($item, 'role:')) {
                $role = substr($item, 5); // 'role:' kısmını çıkar
                if (in_array($role, $userRoles)) {
                    $hasAccess = true; // Rol mevcutsa erişim sağla
                    break; // Rol bulundu, döngüyü sonlandır
                }
            } elseif (str_starts_with($item, 'permission:')) {
                $permission = substr($item, 11); // 'permission:' kısmını çıkar
                if (in_array($permission, $userPermissions) || in_array($permission, $rolePermissions)) {
                    $hasAccess = true; // Kullanıcı veya rol izni varsa erişim sağla
                    break; // İzin bulundu, döngüyü sonlandır
                }
            }
        }

        // Hata ayıklama: Kullanıcının rollerini ve izinlerini yazdır
        Log::info('User roles: ', $userRoles);
        Log::info('User permissions: ', $userPermissions);
        Log::info('User role permissions: ', $rolePermissions);
        Log::info('Requested roles and permissions: ', $rolesAndPermissions);

        // Erişim izni yoksa hata döndür
        if (!$hasAccess) {
            abort(403);
        }

        return $next($request);
    }
}
