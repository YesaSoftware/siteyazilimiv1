<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;

use App\Models\User;

use Yajra\DataTables\Facades\DataTables;


class RolesController extends Controller
{

    public function list()
    {
        $tableThead = [
            'id','name'
        ];
        return view('panel.roles.index',["data" => $tableThead]);
    }


    public function listData()
    {
        $model = Role::query();

        return DataTables::eloquent($model)->make(true);

    }

    public function rolePermissionList($id)
    {
        $role = Role::with('permissions')->find($id);

        if (!$role) {
            abort(404);
        }

        if ($role->name == 'member')
        {
            return redirect()->route('panel.roles.list')->with('error', 'Bu rol için izin düzenlenemez.');
        }

        if ($role->name == 'developer')
        {
            return redirect()->route('panel.roles.list')->with('error', 'Bu rol için izin düzenlenemez.');
        }


        // Fetch all permission groups along with their permissions
        $permissionGroups = PermissionGroup::with('permissions')->get();

        // Fetch permissions without a group
        $ungroupedPermissions = Permission::whereNull('permission_group_id')->get();

        return view('panel.roles.permissionList', [
            "role" => $role,
            "permissionGroups" => $permissionGroups,
            "ungroupedPermissions" => $ungroupedPermissions
        ]);
    }


    public function updatePermission(Request $request, $id)
    {
        // İzinleri al
        $permissions = $request->input('permissions', []);

        // Rolü bul
        $role = Role::findOrFail($id);

        // Mevcut izinleri güncelle
        $role->permissions()->sync($permissions);

        // Başarılı bir güncelleme mesajı ile geri dön
        return redirect()->back()->with('success', 'İzinler başarıyla güncellendi.');
    }


    public function createPermission()
    {
        $list = [[
            "title" => "Üye",
            "name" => "users"
        ]];
        foreach ($list as $i) {
            $moduleName = $i["name"];



            // Grup ismini oluştur
            $groupName = $i["name"]; // ASCII'ye çevir
            $groupTitle = $i["title"];

            // İzinleri oluştur
            $permissions = [
                $moduleName . '_add' => 'Ekleme',
                $moduleName . '_edit' => 'Düzenleme',
                $moduleName . '_list' => 'Listeleme'
            ];

            // Grup oluştur (örneğin, PermissionGroup modelini kullanarak)
            $permissionGroup = PermissionGroup::create([
                'title' => $groupTitle,
            ]);

            $permissionGroupId = $permissionGroup->id;

            // İzinleri ekle
            foreach ($permissions as $name => $title) {
                $permissionName = $name; // ASCII'ye çevir


                Permission::create([
                    'name' => $permissionName,
                    'title' => $title,
                    'guard_name' => 'web',
                    'permission_group_id' => $permissionGroupId
                ]);
            }
        }

        return 'Permissions created for ' . $moduleName;
    }


    function convertToAscii($string) {
        $turkishCharacters = ['ç', 'ğ', 'ı', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'İ', 'Ö', 'Ş', 'Ü'];
        $asciiCharacters = ['c', 'g', 'i', 'o', 's', 'u', 'C', 'G', 'I', 'O', 'S', 'U'];

        return strtolower(str_replace($turkishCharacters, $asciiCharacters, $string));
    }



}
