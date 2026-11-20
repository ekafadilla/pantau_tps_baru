
<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UptdLaporanController;
use App\Http\Controllers\PengaturanMasyarakatController;
use App\Http\Controllers\SupirDashboardController;
use App\Http\Controllers\SupirTugasController;
use App\Http\Controllers\AdminTpsController;




Route::get('/', function () {
    return view('landing.index');
})->name('landing');


Route::get('/masyarakat/pengaturan', [
    PengaturanMasyarakatController::class,
    'edit'
])->name('masyarakat.pengaturan.edit');

Route::put('/masyarakat/pengaturan', [
    PengaturanMasyarakatController::class,
    'update'
])->name('masyarakat.pengaturan.update');

Route::put('/masyarakat/pengaturan/kata-sandi', [
    PengaturanMasyarakatController::class,
    'updatePassword'
])->name('masyarakat.pengaturan.password');


Route::middleware('guest')->group(function () {

    Route::get('/login', [
        AuthController::class,
        'showLogin'
    ])->name('login');

    Route::post('/login', [
        AuthController::class,
        'login'
    ])->name('login.store');

    Route::get('/register', [
        AuthController::class,
        'showRegister'
    ])->name('register');

    Route::post('/register', [
        AuthController::class,
        'register'
    ])->name('register.store');

});


Route::middleware('auth')->group(function () {

    // DASHBOARD UMUM
    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    Route::get('/dashboard/{role}', [
        DashboardController::class,
        'show'
    ])->whereIn('role', [
        'masyarakat',
        'uptd',
        'supir',
        'admin'
    ])->name('dashboard.role');


    // LOGOUT
    Route::post('/logout', [
        AuthController::class,
        'logout'
    ])->name('logout');


    // LAPORAN MASYARAKAT
    Route::get('/masyarakat/laporan/buat', [
        LaporanController::class,
        'create'
    ])->name('masyarakat.laporan.create');

    Route::post('/masyarakat/laporan', [
        LaporanController::class,
        'store'
    ])->name('masyarakat.laporan.store');

    Route::get('/masyarakat/laporan/saya', [
        LaporanController::class,
        'index'
    ])->name('masyarakat.laporan.index');

    Route::get('/masyarakat/laporan/{laporan}', [
        LaporanController::class,
        'show'
    ])->whereNumber('laporan')
      ->name('masyarakat.laporan.show');


    // LAPORAN UPTD
    Route::get('/uptd/laporan', [
        UptdLaporanController::class,
        'index'
    ])->name('uptd.laporan.index');

    Route::get('/uptd/laporan/{laporan}', [
        UptdLaporanController::class,
        'show'
    ])->whereNumber('laporan')
      ->name('uptd.laporan.show');

});


// ==================================================
// PEMULIHAN KATA SANDI
// ==================================================

Route::middleware('guest')->group(function () {

    Route::get('/forgot-password', [
        \App\Http\Controllers\PasswordResetController::class,
        'create'
    ])->name('password.request');

    Route::post('/forgot-password', [
        \App\Http\Controllers\PasswordResetController::class,
        'sendLink'
    ])->name('password.email');

    Route::get('/reset-password/{token}', [
        \App\Http\Controllers\PasswordResetController::class,
        'showResetForm'
    ])->name('password.reset');

    Route::post('/reset-password', [
        \App\Http\Controllers\PasswordResetController::class,
        'reset'
    ])->name('password.update');

});


// ==================================================
// FITUR UPTD
// ==================================================

Route::middleware('auth')->get('/uptd/tps', [
    \App\Http\Controllers\UptdTpsController::class,
    'index'
])->name('uptd.tps.index');


Route::middleware('auth')->prefix('uptd')->name('uptd.')->group(function () {

    Route::get('/pengaturan', [
        \App\Http\Controllers\UptdPengaturanController::class,
        'edit'
    ])->name('pengaturan.edit');

    Route::put('/pengaturan', [
        \App\Http\Controllers\UptdPengaturanController::class,
        'update'
    ])->name('pengaturan.update');

    Route::put('/pengaturan/kata-sandi', [
        \App\Http\Controllers\UptdPengaturanController::class,
        'updatePassword'
    ])->name('pengaturan.password');

});


// ==================================================
// FITUR SUPIR
// ==================================================

Route::middleware('auth')->group(function () {

    // DASHBOARD SUPIR
    Route::get('/supir/dashboard', [
        SupirDashboardController::class,
        'index'
    ])->name('supir.dashboard');


    // DAFTAR TUGAS
    Route::get('/supir/tugas', [
        SupirTugasController::class,
        'index'
    ])->name('supir.tugas.index');


    // MENU DETAIL DAN PROGRES TUGAS
    // Route ini mencari tugas aktif milik supir
    Route::get('/supir/tugas/aktif', [
        SupirTugasController::class,
        'aktif'
    ])->name('supir.tugas.aktif');


    // DETAIL TUGAS
    Route::get('/supir/tugas/{id}', [
        SupirTugasController::class,
        'show'
    ])->whereNumber('id')
      ->name('supir.tugas.show');


    // MULAI PENANGANAN
    Route::post('/supir/tugas/{id}/mulai', [
        SupirTugasController::class,
        'mulai'
    ])->whereNumber('id')
      ->name('supir.tugas.mulai');


    // SIMPAN PROGRES DAN FOTO
    Route::post('/supir/tugas/{id}/progres', [
        SupirTugasController::class,
        'perbaruiProgres'
    ])->whereNumber('id')
      ->name('supir.tugas.progres');


    // KIRIM PENANGANAN UNTUK PEMERIKSAAN
    Route::post('/supir/tugas/{id}/selesai', [
        SupirTugasController::class,
        'selesaikan'
    ])->whereNumber('id')
      ->name('supir.tugas.selesai');

});


// ==================================================
// DASHBOARD ADMIN
// ==================================================

Route::middleware('auth')->get('/admin/dashboard', [
    \App\Http\Controllers\AdminDashboardController::class,
    'index'
])->name('admin.dashboard');


// ==================================================
// PENGELOLAAN PENGGUNA ADMIN
// ==================================================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/pengguna', [
        \App\Http\Controllers\AdminPenggunaController::class,
        'index'
    ])->name('pengguna.index');

    Route::get('/pengguna/tambah', [
        \App\Http\Controllers\AdminPenggunaController::class,
        'create'
    ])->name('pengguna.create');

    Route::post('/pengguna', [
        \App\Http\Controllers\AdminPenggunaController::class,
        'store'
    ])->name('pengguna.store');

    Route::get('/pengguna/{user}/edit', [
        \App\Http\Controllers\AdminPenggunaController::class,
        'edit'
    ])->whereNumber('user')
      ->name('pengguna.edit');

    Route::put('/pengguna/{user}', [
        \App\Http\Controllers\AdminPenggunaController::class,
        'update'
    ])->whereNumber('user')
      ->name('pengguna.update');

    Route::delete('/pengguna/{user}', [
        \App\Http\Controllers\AdminPenggunaController::class,
        'destroy'
    ])->whereNumber('user')
      ->name('pengguna.destroy');

});


// ==================================================
// PENGELOLAAN WILAYAH ADMIN
// ==================================================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/wilayah', [
        \App\Http\Controllers\AdminWilayahController::class,
        'index'
    ])->name('wilayah.index');

    Route::get('/wilayah/tambah', [
        \App\Http\Controllers\AdminWilayahController::class,
        'create'
    ])->name('wilayah.create');

    Route::post('/wilayah', [
        \App\Http\Controllers\AdminWilayahController::class,
        'store'
    ])->name('wilayah.store');

    Route::get('/wilayah/{wilayah}/edit', [
        \App\Http\Controllers\AdminWilayahController::class,
        'edit'
    ])->whereNumber('wilayah')
      ->name('wilayah.edit');

    Route::put('/wilayah/{wilayah}', [
        \App\Http\Controllers\AdminWilayahController::class,
        'update'
    ])->whereNumber('wilayah')
      ->name('wilayah.update');

    Route::delete('/wilayah/{wilayah}', [
        \App\Http\Controllers\AdminWilayahController::class,
        'destroy'
    ])->whereNumber('wilayah')
      ->name('wilayah.destroy');

});


// ==================================================
// PENGELOLAAN TPS ADMIN
// ==================================================

Route::middleware('auth')->group(function () {

    Route::get('/admin/tps', [
        AdminTpsController::class,
        'index'
    ])->name('admin.tps.index');

    Route::get('/admin/tps/tambah', [
        AdminTpsController::class,
        'create'
    ])->name('admin.tps.create');

    Route::post('/admin/tps', [
        AdminTpsController::class,
        'store'
    ])->name('admin.tps.store');

    Route::get('/admin/tps/{tps}/edit', [
        AdminTpsController::class,
        'edit'
    ])->name('admin.tps.edit');

    Route::put('/admin/tps/{tps}', [
        AdminTpsController::class,
        'update'
    ])->name('admin.tps.update');

    Route::delete('/admin/tps/{tps}', [
        AdminTpsController::class,
        'destroy'
    ])->name('admin.tps.destroy');

    Route::get('/admin/tps/{tps}', [
        AdminTpsController::class,
        'show'
    ])->whereNumber('tps')
      ->name('admin.tps.show');

});


// ==================================================
// EDIT LANDING PAGE ADMIN
// ==================================================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/landing-page', [
        \App\Http\Controllers\AdminLandingPageController::class,
        'edit'
    ])->name('landing.edit');

    Route::put('/landing-page', [
        \App\Http\Controllers\AdminLandingPageController::class,
        'update'
    ])->name('landing.update');

});


// ==================================================
// DATA LAPORAN ADMIN
// ==================================================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/laporan', [
        \App\Http\Controllers\AdminLaporanController::class,
        'index'
    ])->name('laporan.index');

    Route::get('/laporan/{laporan}', [
        \App\Http\Controllers\AdminLaporanController::class,
        'show'
    ])->whereNumber('laporan')
      ->name('laporan.show');

});
