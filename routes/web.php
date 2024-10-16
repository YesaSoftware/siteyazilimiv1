<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\Panel\RolesController as PanelRoles;
use App\Http\Controllers\Panel\UsersController as PanelUser;
use App\Http\Controllers\Panel\LogsController as PanelLogs;
use App\Http\Controllers\Panel\SystemSettingsController as PanelSystemSettings;
use App\Http\Controllers\Panel\LanguagesController as PanelLanguages;
use App\Http\Controllers\HomeController as Home;

Route::middleware(['setLocale'])->group(function () {

    Route::get('set-language/{lang}', [LanguageController::class, 'setLanguage'])->name('set.language');
    Route::get('/', fn() => view('welcome'))->name('site.welcome');
    Auth::routes(['verify' => true]);
    Route::get('/home', [Home::class, 'index'])->name('home');

    Route::middleware(['auth', 'verified'])->group(function () {

        Route::group(['prefix' => 'panel', 'as' => 'panel.'], function () {
            Route::get('/', fn() => view('panel.home'))->name('home');

            // Roles
            Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
                Route::controller(PanelRoles::class)->group(function () {
                    Route::get('list', 'list')->name('list')->middleware('permission_control:rol_list');
                    Route::get('role_permission/list/{id}', 'rolePermissionList')->name('permission.list')->middleware('permission_control:rol_edit');
                    Route::get('list/data', 'listData')->name('list.data');
                    Route::post('role_permission/update/{id}', 'updatePermission')->name('permission.update');
                });
            });

            // Users
            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::controller(PanelUser::class)->group(function () {
                    Route::get('create', 'create')->name('create')->middleware('permission_control:users_create');
                    Route::post('store', 'store')->name('store')->middleware('permission_control:users_create');
                    Route::get('list', 'list')->name('list')->middleware('permission_control:users_list');
                    Route::get('list/data', 'listData')->name('list.data')->middleware('permission_control:users_list');
                    Route::get('edit/{id}', 'edit')->name('edit')->middleware('permission_control:users_edit');
                    Route::put('update/{id}', 'update')->name('update')->middleware('permission_control:users_edit');
                    Route::get('permissions/{id}', 'showUserPermissions')->name('permissions')->middleware('permission_control:users_permission_edit');
                    Route::post('permissions/{id}', 'updateUserPermissions')->name('permissions.update')->middleware('permission_control:users_permission_edit');
                    Route::delete('destroy/{id}', 'destroy')->name('destroy')->middleware('permission_control:users_delete');
                });
            });

            // Logs
            Route::group(['prefix' => 'logs', 'as' => 'logs.'], function () {
                Route::controller(PanelLogs::class)->group(function () {
                    Route::get('list', 'list')->name('list')->middleware('permission_control:logs_list');
                    Route::get('show/{id}', 'show')->name('show')->middleware('permission_control:logs_list');
                    Route::get('list/data', 'listData')->name('list.data')->middleware('permission_control:logs_list');
                });
            });

            // Languages
            Route::group(['prefix' => 'languages', 'as' => 'languages.'], function () {
                Route::controller(PanelLanguages::class)->group(function () {
                    Route::get('list', 'list')->name('list')->middleware('permission_control:languages_list');
                    Route::get('list/data', 'listData')->name('list.data')->middleware('permission_control:languages_list');
                });
            });

            // System Settings
            Route::group(['prefix' => 'system', 'as' => 'system.'], function () {
                Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
                    Route::controller(PanelSystemSettings::class)->group(function () {
                        Route::get('list', 'list')->name('list')->middleware('permission_control:system_settings_list');
                        Route::put('update/{id}', 'update')->name('update')->middleware('permission_control:system_settings_edit');
                        Route::post('store', 'store')->name('store')->middleware('permission_control:system_settings_edit');
                    });
                });
            });
        });
    });
});
