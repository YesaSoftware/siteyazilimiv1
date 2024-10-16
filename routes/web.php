<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\MembersController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

use App\Models\User;

use App\Http\Controllers\Panel\RolesController as PanelRolesController;
use App\Http\Controllers\Panel\UsersController as PanelUserController;
use App\Http\Controllers\Panel\LogsController as PanelLogsController;
use App\Http\Controllers\Panel\SystemSettingsController as PanelSystemSettingsController;
use App\Http\Controllers\Panel\LanguagesController as PanelLanguagesController;
use App\Http\Controllers\HomeController;


use Illuminate\Support\Facades\App;


Route::middleware(['setLocale'])->group(function () {


    Route::get('set-language/{lang}', [LanguageController::class, 'setLanguage'])->name('set.language');


    Route::get('/', function () {
        return view('welcome');
    })->name('site.welcome');

    Auth::routes(['verify' => true]);


    Route::get('/layoutv3', function () {
        return view('layouts.panel3');
    })->name('layoutv3');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['auth', 'verified'])->group(function () {


        Route::prefix('panel')->group(function () {
            Route::get('', function () {
                return view('panel.home');
            })->name('panel.home');


            Route::prefix('roles')->group(function () {
                Route::get('list', [PanelRolesController::class, 'list'])->name('panel.roles.list')
                    ->middleware('permission_control:rol_list');
                Route::get('list/data', [PanelRolesController::class, 'listData'])->name('panel.roles.list.data');
                Route::get('role_permission/list/{id}', [PanelRolesController::class, 'rolePermissionList'])
                    ->middleware('permission_control:rol_edit')
                    ->name('panel.roles.permission.list');

                Route::post('role_permission/update/{id}', [PanelRolesController::class, 'updatePermission'])->name('panel.roles.permission.update');

            });

            Route::prefix('users')->group(function () {

                Route::get('create', [PanelUserController::class, 'create'])
                    ->middleware('permission_control:users_create')
                    ->name('panel.users.create');

                Route::post('store', [PanelUserController::class, 'store'])
                    ->middleware('permission_control:users_create')
                    ->name('panel.users.store');

                Route::get('list', [PanelUserController::class, 'list'])
                    ->middleware('permission_control:users_list')
                    ->name('panel.users.list');

                Route::get('list/data', [PanelUserController::class, 'listData'])
                    ->middleware('permission_control:users_list')
                    ->name('panel.users.list.data');

                Route::get('edit/{id}', [PanelUserController::class, 'edit'])
                    ->middleware('permission_control:users_edit')
                    ->name('panel.users.edit');
                Route::put('update/{id}', [PanelUserController::class, 'update'])
                    ->middleware('permission_control:users_edit')
                    ->name('panel.users.update');

                Route::get('permissions/{id}', [PanelUserController::class, 'showUserPermissions'])
                    ->middleware('permission_control:users_permission_edit')
                    ->name('panel.users.permissions');

                Route::post('permissions/{id}', [PanelUserController::class, 'updateUserPermissions'])
                    ->middleware('permission_control:users_permission_edit')
                    ->name('panel.users.permissions.update');

                Route::delete('destroy/{id}', [PanelUserController::class, 'destroy'])
                    ->middleware('permission_control:users_delete')
                    ->name('panel.users.destroy');
            });

            Route::prefix('logs')->group(function () {
                Route::get('list', [PanelLogsController::class, 'list'])
                    ->middleware('permission_control:logs_list')
                    ->name('panel.logs.list');

                Route::get('show/{id}', [PanelLogsController::class, 'show'])
                    ->middleware('permission_control:logs_list')
                    ->name('panel.logs.show');
                Route::get('list/data', [PanelLogsController::class, 'listData'])
                    ->middleware('permission_control:logs_list')
                    ->name('panel.logs.list.data');
            });

            Route::prefix('languages')->group(function () {
                Route::get('list', [PanelLanguagesController::class, 'list'])
                    ->middleware('permission_control:languages_list')
                    ->name('panel.languages.list');

                Route::get('list/data', [PanelLanguagesController::class, 'listData'])
                    ->middleware('permission_control:languages_list')
                    ->name('panel.languages.list.data');
            });

            Route::prefix('system/settings')->group(function () {
                Route::get('list', [PanelSystemSettingsController::class, 'list'])
                    ->middleware('permission_control:system_settings_list')
                    ->name('panel.system.settings.list');


                Route::put('update/{id}', [PanelSystemSettingsController::class, 'update'])
                    ->middleware('permission_control:system_settings_edit')
                    ->name('panel.system.settings.update');


                Route:: post('store', [PanelSystemSettingsController::class, 'store'])
                    ->middleware('permission_control:system_settings_edit')
                    ->name('panel.system.settings.store');

            });
        });
    });
});
