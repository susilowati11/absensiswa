<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\usermiddleware;
use App\Http\Middleware\adminmiddleware;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DatasiswaController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotifikasiSiswaController;
use App\Http\Controllers\RiwayatkehadiranController;
use App\Http\Controllers\notifikasikehadiranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    // routes/web.php
                                          
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware([usermiddleware::class])->group(function () {
        Route::prefix('siswa')->group(function () {
            Route::get('/', [SiswaController::class, 'index'])->name('siswa');
            Route::post('/siswa', [SiswaController::class, 'siswa'])->name('create.siswa');
            Route::put('/update/{id_siswa}', [SiswaController::class, 'update'])->name('siswa.update');
            Route::delete('/destroy/{id_siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
        });
        Route::prefix('kehadiran')->group(function () {
            Route::get('/', [KehadiranController::class, 'index'])->name('kehadiran');
            Route::post('/kehadiran/kehadiran/store', [KehadiranController::class, 'store'])->name('kehadiran.store');
            Route::put('kehadiran/update/{id}', [KehadiranController::class, 'update'])->name('kehadiran.update');
            Route::delete('/destroy/{id}', [KehadiranController::class, 'destroy'])->name('kehadiran.destroy');
        });
        Route::prefix('notifikasi-siswa')->group(function () {
            Route::get('/', [NotifikasiSiswaController::class, 'index'])->name('notifikasi-siswa');
        });
    });



    Route::middleware([adminmiddleware::class])->group(function () {
        Route::prefix('kelas')->group(function () {
            Route::get('/', [KelasController::class, 'index'])->name('kelas');
            Route::post('/store', [KelasController::class, 'store'])->name('kelas.store');
            Route::put('/update/{id}', [KelasController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [KelasController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('notifikasikehadiran')->group(function () {
            Route::get('/', [notifikasikehadiranController::class, 'index'])->name('notifikasikehadiran');
            Route::post('notifikasikehadiran/store', [NotifikasiKehadiranController::class, 'store'])->name('notifikasikehadiran.store');
            Route::put('notifikasikehadiran/update/{id} ', [notifikasiKehadirancontroller::class, 'update'])->name('notifikasikehadiran.update');
            Route::delete('/destroy/{id}', [notifikasikehadiranController::class, 'destroy'])->name('notifikasikehadiran.destroy');
            // Tambahkan rute lainnya sesuai kebutuhan
        });
        Route::prefix('riwayatkehadiran')->group(function () {
            Route::get('/', [RiwayatkehadiranController::class, 'index'])->name('riwayatkehadiran');
            Route::post('/store', [RiwayatkehadiranController::class, 'store'])->name('riwayatkehadiran.store');
        });
        Route::prefix('datasiswa')->group(function () {
            Route::get('/', [DatasiswaController::class, 'index'])->name('datasiswa');
            Route::post('/store', [DatasiswaController::class, 'store'])->name('datasiswa.store');
        });
    });
});
