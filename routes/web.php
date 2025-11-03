<?php

use App\Http\Controllers\AllController;
use App\Http\Controllers\jurusanController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QrController;
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
Route::middleware('guest')->group(function(){
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/login/exceute', [LoginController::class, 'actionLogin'])->name('loginAction');
});


Route::middleware('auth')->group(function (){
    // logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // show side bar
    Route::get('/home', [AllController::class, 'index'])->name('home');
    // dashboard
    Route::get('/dashboard', [AllController::class, 'dash'])->name('dash');
    Route::get('/dashboard/create', [AllController::class, 'dashCreate'])->name('dashCreate');
    Route::post('/dashboard/create/Action', [AllController::class, 'dashCreateAction'])->name('dashCreateAction');
    Route::get('/dashboard/update/{id}', [AllController::class,'dashUpdate'])->name('dashUpdate');
    Route::post('/dashboard/update/action/{id}', [AllController::class,'dashUpdateAction'])->name('dashUpdateAction');
    Route::delete('/dashboard/delete/{id}', [AllController::class,'dashDelete'])->name('dashDelete');

    Route::get('/create/data', [AllController::class, 'create'])->name('create');
    Route::post('/reset-telat', [AllController::class, 'reset'])->name('reset');
    // post create siswa
    Route::post('/create/action/data', [AllController::class, 'action'])->name('action');
    Route::get('/manage', [AllController::class, 'manage'])->name('manage');
    // jurusan
    Route::get('/jurusan/manage', [jurusanController::class, 'jurusan'])->name('jurusan');
    Route::post('/jurusan/manage/action', [jurusanController::class, 'actionJurusan'])->name('actionJurusan');
    Route::get('/jurusan/update/{id}', [jurusanController::class, 'update'])->name('jurusanForm');
    Route::post('/jurusan/update/where/{id}', [jurusanController::class, 'jurusanUpdate'])->name('jurusanUpdate');
    Route::delete('/jurusan/delete/{id}', [jurusanController::class, 'delete'])->name('deleteJurusan');

    // kelas
    Route::get('/kelas/manage', [kelasController::class, 'kelas'])->name('kelas');
    Route::post('kelas/manage/action', [kelasController::class, 'actionKelas'])->name('actionKelas');
    Route::get('/kelas/update/{id}', [kelasController::class, 'update'])->name('kelasForm');
    Route::post('/kelas/update/where/{id}', [kelasController::class, 'kelasUpdate'])->name('kelasUpdate');
    Route::delete('/kelas/delete/{id}', [kelasController::class, 'delete'])->name('deleteKelas');

    // qr scan
    Route::get('/qrcode/scan', [QrController::class, 'qrscan'])->name('qrscan');
    // testing qr scan
    Route::get('/Scan/Siswa', [QrController::class, 'scanSiswa'])->name('scanSiswa');
    Route::post('/qrscan/action', [QrController::class, 'scanacti'])->name('scanacti');
    Route::get('/qrscan/lateSiswa', [QrController::class, 'lateTable'])->name('lateTable');
    // Route::post('/qrscan/latesiswa/destroy', [QrController::class, 'destroy'])->name('destroy');
    // qr code
    Route::get('/qrcode/{id}', [AllController::class, 'qrCode'])->name('qrCode');
});
// login

// 404 universal error
// Route::get('/latelink/website/problem', [AllController::class, 'error'])->name('404universal');
