<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\AgenController as AppAgenController;
use App\Http\Controllers\dashboard\DeveloperController as AppDeveloperController;
use App\Http\Controllers\dashboard\SuperAdminController;
use App\Http\Controllers\master\KabupatenController;
use App\Http\Controllers\master\KecamatanController;
use App\Http\Controllers\master\PerumahanController as AppPerumahanController;
use App\Http\Controllers\menu\agen\bookingController;
use App\Http\Controllers\menu\booking_perumahan\BookingPerumahanController;
use App\Http\Controllers\menu\DaftarPerumahanController;
use App\Http\Controllers\menu\developer\BookingPerumahanController as AppBookingPerumahanController;
use App\Http\Controllers\menu\super_admin\BookingController as AppBookingController;
use App\Http\Controllers\menu\super_admin\PerumahanController as AppHttpPerumahanController;
use App\Http\Controllers\pendataan\MapPerumahanController;
use App\Http\Controllers\pendataan\PerumahanController;
use App\Http\Controllers\pendataan\WilayahController;
use App\Http\Controllers\pengaturan\AgenController;
use App\Http\Controllers\pengaturan\DeveloperController;
use App\Http\Controllers\pengaturan\UserController;
use App\Http\Controllers\PertanyaanAgenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['login'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', function () {
            return inertia()->render('dashboard/admin');
        })->name('beranda');
    });

    Route::apiResource('agen', AgenController::class)->middleware('agen');

    Route::group(['prefix' => 'pertanyaan', 'as' => 'pertanyaan.'], function () {
        Route::apiResource('agen', PertanyaanAgenController::class);
    });

    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::apiResource('developer', AppDeveloperController::class);
        Route::apiResource('agen', AppAgenController::class);
        Route::apiResource('admin', AdminController::class);
        Route::apiResource('superadmin', SuperAdminController::class);
    });
    Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
            Route::apiResource('perumahan', BookingPerumahanController::class);
        });
        Route::group(['prefix' => 'data', 'as' => 'data.'], function () {
            Route::group(['prefix' => 'agen', 'as' => 'agen.'], function () {
                Route::apiResource('booking', bookingController::class);
            });
            Route::group(['prefix' => 'developer', 'as' => 'developer.'], function () {
                Route::apiResource('booking', AppBookingPerumahanController::class);
            });
            Route::group(['prefix' => 'superadmin', 'as' => 'superadmin.'], function () {
                Route::apiResource('booking', AppBookingController::class);
                Route::apiResource('perumahan', AppHttpPerumahanController::class);
            });
        });
    });


    Route::group(['prefix' => 'pendataan', 'as' => 'pendataan.'], function () {
        Route::resource('wilayah', WilayahController::class);
        Route::apiResource('perumahan', PerumahanController::class);
    });

    Route::group(['prefix' => 'daftar', 'as' => 'daftar.'], function () {
        Route::apiResource('perumahan', DaftarPerumahanController::class);
    });

    Route::group(['prefix' => 'map', 'as' => 'map.'], function () {
        Route::apiResource('perumahan', MapPerumahanController::class);
    });

    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::apiResource('kabupaten', KabupatenController::class);
        Route::apiResource('kecamatan', KecamatanController::class);
        Route::apiResource('perumahan', AppPerumahanController::class);
    });

    Route::group(['prefix' => 'pengaturan', 'as' => 'pengaturan.'], function () {
        Route::apiResource('user', UserController::class);
        Route::apiResource('agen', AgenController::class);
        Route::post('agen/tambah/dokumen', [AgenController::class, 'tambah_dokumen'])->name('agen.tambah_dokumen');
        Route::post('agen/status/dokumen', [AgenController::class, 'status_dokumen'])->name('agen.status_dokumen');
        Route::apiResource('developer', DeveloperController::class);
        Route::post('developer/{developer}/simpan/lokasi', [DeveloperController::class, 'simpan_lokasi'])->name('developer.simpan_lokasi');
        Route::post('developer/{developer}/upload/dokumen', [DeveloperController::class, 'upload_dokumen'])->name('developer.upload_dokumen');
        Route::delete('developer/hapus/developerperumahan/{developer_perumahan}', [DeveloperController::class, 'hapus_perumahan'])->name('developer.hapus_perumahan');
        Route::put('developer/edit/developerperumahan/{developer_perumahan}', [DeveloperController::class, 'edit_perumahan'])->name('developer.edit_perumahan');
    });
});

Route::group(['prefix' => 'autentikasi'], function () {
    Route::apiResource('login', LoginController::class);
    Route::apiResource('logout', LogoutController::class);
    Route::apiResource('register', RegisterController::class);
});
