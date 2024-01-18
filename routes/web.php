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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotifikasiSiswaController;
use App\Http\Controllers\RiwayatkehadiranController;
use App\Http\Controllers\notifikasikehadiranController;
use App\Http\Controllers\ProfileController;

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
    Route::get('/',[HomeController::class,'index'])->name('home');
    // routes/web.php   
                                          
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('user')->prefix('user')->group(function () {
        Route::prefix('siswa')->group(function () {
            Route::get('/', [SiswaController::class, 'index'])->name('siswa');

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
        Route::get('/upload-foto/upload-photo/{id}', [ProfileController::class, 'index'])->name('upload-photo.show');
        Route::put('/upload-foto/upload-photo/{id}', [ProfileController::class, 'index'])->name('upload-photo.update');     
        
    });



    Route::middleware('admin')->prefix('admin')->group(function () {
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
        });
        Route::prefix('riwayatkehadiran')->group(function () {
            Route::get('/', [RiwayatkehadiranController::class, 'index'])->name('riwayatkehadiran');
            Route::post('/store', [RiwayatkehadiranController::class, 'store'])->name('riwayatkehadiran.store');
        });
        Route::prefix('datasiswa')->group(function () {
            Route::get('/', [DatasiswaController::class, 'index'])->name('datasiswa');
            Route::post('/store', [DatasiswaController::class, 'store'])->name('datasiswa.store');
            Route::put('datasiswa/update/{user_id}', [Datasiswacontroller::class, 'update'])->name('datasiswa.update');
            Route::delete('/destroy/{user_id}', [DatasiswaController::class, 'destroy'])->name('datasiswa.destroy');
        });
    });
});
// ([usermiddleware::class])
