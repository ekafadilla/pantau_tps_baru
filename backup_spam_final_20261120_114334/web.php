
<?php

use App\Http\Controllers\AdminSpamController;
use App\Http\Controllers\SupirTugasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UptdLaporanController;

// Halaman utama
Route::get('/', function () {
    return view('landing.index');
})->name('landing');



// Login dan register
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:login')->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:daftar')->name('register.store');
});

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');

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
        ->middleware('verified')->name('masyarakat.laporan.create');

    Route::post('/masyarakat/laporan', [LaporanController::class, 'store'])
        ->middleware(['verified','throttle:user-reports'])->name('masyarakat.laporan.store');

     Route::get('/masyarakat/laporan/{laporan}', [LaporanController::class, 'show'])
    ->whereNumber('laporan')
    ->name('masyarakat.laporan.show');

    Route::get('/masyarakat/laporan/saya', [LaporanController::class, 'index'])
        ->name('masyarakat.laporan.index');

   
});

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');

// Pemulihan kata sandi
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [
        \App\Http\Controllers\PasswordResetController::class,
        'create'
    ])->name('password.request');

    Route::post('/forgot-password', [
        \App\Http\Controllers\PasswordResetController::class,
        'sendLink'
    ])->middleware('throttle:reset')->name('password.email');

    Route::get('/reset-password/{token}', [
        \App\Http\Controllers\PasswordResetController::class,
        'showResetForm'
    ])->name('password.reset');

    Route::post('/reset-password', [
        \App\Http\Controllers\PasswordResetController::class,
        'reset'
    ])->middleware('throttle:reset')->name('password.update');
});

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');


Route::middleware('auth')->get('/uptd/tps', [\App\Http\Controllers\UptdTpsController::class, 'index'])
    ->name('uptd.tps.index');



Route::middleware(['auth'])->group(function () {
    Route::get('/supir/tugas', [SupirTugasController::class, 'index'])
        ->name('supir.tugas.index');

    Route::get('/supir/tugas/{id}', [SupirTugasController::class, 'show'])
        ->name('supir.tugas.show');
});

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');

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

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');
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

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');

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

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');

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

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');

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

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');

// Aksi UPTD (verifikasi, tugaskan, tolak)
Route::middleware('auth')->prefix('uptd')->name('uptd.')->group(function () {
    Route::post('/laporan/{laporan}/verifikasi', [UptdLaporanController::class, 'verifikasi'])->whereNumber('laporan')->name('laporan.verifikasi');
    Route::post('/laporan/{laporan}/verifikasi-urgensi', [UptdLaporanController::class, 'verifikasiUrgensi'])->whereNumber('laporan')->name('laporan.verifikasi-urgensi');
    Route::post('/laporan/{laporan}/tugaskan', [UptdLaporanController::class, 'tugaskan'])->whereNumber('laporan')->name('laporan.tugaskan');
    Route::post('/laporan/{laporan}/tolak', [UptdLaporanController::class, 'tolak'])->whereNumber('laporan')->name('laporan.tolak');
});

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');

// Pengaturan akun UPTD
Route::middleware('auth')->prefix('uptd')->name('uptd.')->group(function () {


});

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');



// Peta: lokasi supir (dibagikan supir, dibaca admin & UPTD)
Route::middleware('auth')->group(function () {
    Route::post('/supir/lokasi', [\App\Http\Controllers\LokasiSupirController::class, 'simpan'])
        ->middleware('throttle:30,1')
        ->name('supir.lokasi.simpan');

    Route::delete('/supir/lokasi', [\App\Http\Controllers\LokasiSupirController::class, 'hapus'])
        ->name('supir.lokasi.hapus');

    Route::get('/peta/supir', [\App\Http\Controllers\LokasiSupirController::class, 'daftar'])
        ->name('peta.supir');
});

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');
// Verifikasi email
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [\App\Http\Controllers\VerifikasiEmailController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\VerifikasiEmailController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', [\App\Http\Controllers\VerifikasiEmailController::class, 'kirimUlang'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');
// Pengaturan akun terpadu (semua role)
Route::middleware('auth')->prefix('pengaturan')->name('pengaturan.')->group(function () {
    Route::get('/', [\App\Http\Controllers\PengaturanController::class, 'edit'])
        ->name('edit');

    Route::put('/profil', [\App\Http\Controllers\PengaturanController::class, 'updateProfil'])
        ->name('profil');

    Route::put('/kata-sandi', [\App\Http\Controllers\PengaturanController::class, 'updatePassword'])
        ->name('password');
});

// Admin spam management (UPTD)
Route::get('/admin/spam', [AdminSpamController::class, 'index'])->name('admin.spam.index');
Route::post('/admin/spam/{user}/reset', [AdminSpamController::class, 'reset'])->name('admin.spam.reset');