
<?php

use App\Http\Controllers\SupirTugasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UptdLaporanController;
use App\Http\Controllers\PengaturanMasyarakatController;

// Halaman utama
Route::get('/', function () {
    return view('landing.index');
})->name('landing');

// Pengaturan masyarakat
// Pengaturan akun Masyarakat
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

// Login dan register
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

// Dashboard dan fitur setelah login
Route::middleware('auth')->group(function () {
Route::get('/uptd/laporan', [UptdLaporanController::class, 'index'])
    ->name('uptd.laporan.index');
Route::get('/uptd/laporan/{laporan}', [UptdLaporanController::class, 'show'])
    ->whereNumber('laporan')
    ->name('uptd.laporan.show');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/{role}', [DashboardController::class, 'show'])
        ->whereIn('role', ['masyarakat', 'uptd', 'supir', 'admin'])
        ->name('dashboard.role');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Buat laporan masyarakat
    Route::get('/masyarakat/laporan/buat', [LaporanController::class, 'create'])
        ->name('masyarakat.laporan.create');

    Route::post('/masyarakat/laporan', [LaporanController::class, 'store'])
        ->name('masyarakat.laporan.store');

     Route::get('/masyarakat/laporan/{laporan}', [LaporanController::class, 'show'])
    ->whereNumber('laporan')
    ->name('masyarakat.laporan.show');

    Route::get('/masyarakat/laporan/saya', [LaporanController::class, 'index'])
        ->name('masyarakat.laporan.index');

   
});

// Lupa kata sandi
Route::middleware('guest')->get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');


Route::middleware('auth')->get('/uptd/tps', [\App\Http\Controllers\UptdTpsController::class, 'index'])
    ->name('uptd.tps.index');



Route::middleware(['auth'])->group(function () {
    Route::get('/supir/tugas', [SupirTugasController::class, 'index'])
        ->name('supir.tugas.index');

    Route::get('/supir/tugas/{id}', [SupirTugasController::class, 'show'])
        ->name('supir.tugas.show');
});

use App\Http\Controllers\SupirDashboardController;

Route::middleware('auth')->get(
    '/supir/dashboard',
    [SupirDashboardController::class, 'index']
)->name('supir.dashboard');
Route::middleware('auth')->get(
    '/admin/dashboard',
    [\App\Http\Controllers\AdminDashboardController::class, 'index']
)->name('admin.dashboard');
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/pengguna', [\App\Http\Controllers\AdminPenggunaController::class, 'index'])
        ->name('pengguna.index');

    Route::get('/pengguna/tambah', [\App\Http\Controllers\AdminPenggunaController::class, 'create'])
        ->name('pengguna.create');

    Route::post('/pengguna', [\App\Http\Controllers\AdminPenggunaController::class, 'store'])
        ->name('pengguna.store');

    Route::get('/pengguna/{user}/edit', [\App\Http\Controllers\AdminPenggunaController::class, 'edit'])
        ->whereNumber('user')
        ->name('pengguna.edit');

    Route::put('/pengguna/{user}', [\App\Http\Controllers\AdminPenggunaController::class, 'update'])
        ->whereNumber('user')
        ->name('pengguna.update');

    Route::delete('/pengguna/{user}', [\App\Http\Controllers\AdminPenggunaController::class, 'destroy'])
        ->whereNumber('user')
        ->name('pengguna.destroy');
});
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/wilayah', [\App\Http\Controllers\AdminWilayahController::class, 'index'])
        ->name('wilayah.index');

    Route::get('/wilayah/tambah', [\App\Http\Controllers\AdminWilayahController::class, 'create'])
        ->name('wilayah.create');

    Route::post('/wilayah', [\App\Http\Controllers\AdminWilayahController::class, 'store'])
        ->name('wilayah.store');

    Route::get('/wilayah/{wilayah}/edit', [\App\Http\Controllers\AdminWilayahController::class, 'edit'])
        ->whereNumber('wilayah')
        ->name('wilayah.edit');

    Route::put('/wilayah/{wilayah}', [\App\Http\Controllers\AdminWilayahController::class, 'update'])
        ->whereNumber('wilayah')
        ->name('wilayah.update');

    Route::delete('/wilayah/{wilayah}', [\App\Http\Controllers\AdminWilayahController::class, 'destroy'])
        ->whereNumber('wilayah')
        ->name('wilayah.destroy');
});

use App\Http\Controllers\AdminTpsController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/tps', [AdminTpsController::class, 'index'])
        ->name('admin.tps.index');

    Route::get('/admin/tps/{tps}', [AdminTpsController::class, 'show'])
        ->whereNumber('tps')
        ->name('admin.tps.show');

    Route::get('/admin/tps/tambah', [AdminTpsController::class, 'create'])
        ->name('admin.tps.create');

    Route::post('/admin/tps', [AdminTpsController::class, 'store'])
        ->name('admin.tps.store');

    Route::get('/admin/tps/{tps}/edit', [AdminTpsController::class, 'edit'])
        ->name('admin.tps.edit');

    Route::put('/admin/tps/{tps}', [AdminTpsController::class, 'update'])
        ->name('admin.tps.update');

    Route::delete('/admin/tps/{tps}', [AdminTpsController::class, 'destroy'])
        ->name('admin.tps.destroy');
});

// Edit Landing Page
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

// Data Laporan Admin
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/laporan', [
        \App\Http\Controllers\AdminLaporanController::class,
        'index'
    ])->name('laporan.index');

    Route::get('/laporan/{laporan}', [
        \App\Http\Controllers\AdminLaporanController::class,
        'show'
    ])->whereNumber('laporan')->name('laporan.show');
});