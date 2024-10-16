<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Auth\Events\Registered;

use App\Models\Permission;
use App\Models\PermissionGroup;

use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\Validator;

use Faker\Factory as Faker;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\Mail;


class UsersController extends Controller
{
    public function list()
    {

        // email send

       /* $toEmail = 'eser.karlik@gmail.com';
        $subject = 'Düz Metin E-posta';
        $message = "Bu, düz metin olarak gönderilen bir e-postadır.\n\nİyi günler!";

        Mail::raw($message, function ($mail) use ($toEmail, $subject) {
            $mail->to($toEmail)
                ->subject($subject);
        });*/


        $tableThead = [
            'id','name'
        ];
        return view('panel.users.index',["data" => $tableThead]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('panel.users.create', ['roles' => $roles]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('panel.users.edit', ['user' => $user,'roles' => $roles]);
    }

    public function store(Request $request)
    {
        // Validasyon
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
        ]);

        // Kullanıcıyı oluşturma
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'status' => 'active',
        ]);


        if ($user){
            if ($validatedData['role'] == 1){
                $user->roles()->attach(3);
            }else{
                $user->roles()->attach($validatedData['role']);
            }

            logHelper(auth()->id(), 'insert', 'users', 'Kullanıcı oluşturuldu.', $request->all());
        }

        return redirect()->route('panel.users.create')->with('success', 'Kullanıcı başarıyla eklendi.');
    }

    public function update  (Request $request, $id)
    {
        // Kullanıcıyı veritabanından bul
        $user = User::findOrFail($id);

        // Geçerli olan alanları kontrol etmek için bir validator oluştur
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'status' => 'required|in:active,inactive',
            'role' => 'required|string|max:255',
        ]);

        // Validasyon hatası varsa geri döndür
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Kullanıcı bilgilerini güncelle
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        // Kullanıcının rolünü güncelle


        $user->roles()->sync([$request->role]);



        // Eğer şifre verilmişse, güncelle
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save(); // Değişiklikleri kaydet


        logHelper(auth()->id(), 'update', 'users', 'Kullanıcı güncellendi.', $request->all());

        // Başarılı güncelleme mesajı ve yönlendirme
        return redirect()->route('panel.users.list')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }


    public function listData()
    {
        $model = User::query();

        // status = deleted not view

        $model->where('status','!=','deleted');



        return DataTables::eloquent($model)
            ->addColumn('user_role',function($row){
                return $row->roles->first()->name ?? 'Rol atanmamış';
            })
            ->editColumn('status',function($row){
                if ($row->status == 'active'){
                    return '<span class="badge text-bg-success">Aktif</span>';
                }else if ($row->status == 'inactive') {
                    return '<span class="badge text-bg-danger">Pasif</span>';
                }
            })
            ->editColumn('email',function($row){
                $emailVerified = $row->email_verified_at ? '<span class="badge text-bg-success">Doğrulandı</span>' : '<span class="badge text-bg-danger">Doğrulanmadı</span>';
                return $row->email . ' ' . $emailVerified;
            })
            ->rawColumns(['email','status'])
            ->make(true);

    }

    public function showUserPermissions($userId)
    {
        // Kullanıcıyı ve ilişkili izinlerini ve rolleri yükle
        $user = User::with(['permissions', 'roles.permissions'])->findOrFail($userId);

        // Kullanıcının rollerinden gelen izin ID'lerini al
        // Model üzerinden foreach et üyenin rollerini al sonra modelden bul



        $userRolePermissions = $user->roles->flatMap(function ($role) {
            return Role::find($role->id)->permissions;
        })->pluck('id')->unique();

        // Kullanıcıya ait izin ID'lerini al
        $userPermissions = $user->permissions->pluck('id')->unique();

        // Tüm izin gruplarını ve izinlerini al
        $permissionGroups = PermissionGroup::with('permissions')->get();

        // Gruplandırılmamış izinleri al
        $ungroupedPermissions = Permission::whereNull('permission_group_id')->get();

        return view('panel.users.permissions', [
            'user' => $user,
            'userRoles' => $user->roles, // Eklendi
            'userRolePermissions' => $userRolePermissions,
            'userPermissions' => $userPermissions,
            'permissionGroups' => $permissionGroups,
            'ungroupedPermissions' => $ungroupedPermissions,
        ]);
    }

    public function updateUserPermissions(Request $request, $userId)
    {
        // Kullanıcıyı bul
        $user = User::findOrFail($userId);

        // İzinleri güncelle
        $permissions = $request->input('permissions', []);
        $user->permissions()->sync($permissions);

        logHelper(auth()->id(), 'update', 'users', 'Kullanıcı izinleri güncellendi.', $request->all());

        return redirect()->back()->with('success', 'İzinler başarıyla güncellendi.');
    }

    public function destroy($userId)
    {
        $user = User::find($userId);

        if ($user){
            // update status

            $user->status = 'deleted';
            $user->save();

            logHelper(auth()->id(), 'delete', 'users', 'Kullanıcı silindi.', $user->toArray());

            return response()->json(['status' => true,'message'=>'Üye başarıyla silindi.']);
        }

        return response()->json(['status' => false,'message'=>'Üye bulunamadı.'], 400);
    }
}
