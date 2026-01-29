<?php

use App\Http\Controllers\Others\StudentReturnsController;
use App\Http\Controllers\SK\AdmissionLettersController;
use App\Http\Controllers\SK\DataCorrectionsController;
use App\Http\Controllers\SK\GeneralLettersController;
use App\Http\Controllers\SK\GoodConductsController;
use App\Http\Controllers\SP\TravelOrdersController;
use App\Http\Controllers\SPENG\CoverLettersController;
use App\Http\Controllers\SPENG\SchoolTransfersController;
use App\Http\Controllers\SU\ParentInvitationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Autentikasi
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


Route::middleware(['auth'])->group(function () {

    // Surat Perintah
    Route::prefix('sp')->name('sp.')->group(function () {

        // Perjalanan Dinas
        Route::resource('travelOrders', TravelOrdersController::class);
        // routes/web.php atau api.php
        // routes/web.php
        Route::get('/travelOrders/employees/search', [TravelOrdersController::class, 'search'])
            ->name('employees.search');
    });

    // Surat Undangan
    Route::prefix('su')->name('su.')->group(function () {

        // Orang Tua
        Route::resource('parentInvitations', ParentInvitationController::class);
    });

    // Surat Pengantar
    Route::prefix('s_peng')->name('s_peng.')->group(function () {

        // Surat Pengantar
        Route::resource('coverLetters', CoverLettersController::class);

        // Pengantar Pindah
        Route::resource('schoolTransfers', SchoolTransfersController::class);
    });

    // Surat Keterangan
    Route::prefix('sk')->name('sk.')->group(function () {

        // Kelakuan Baik
        Route::resource('goodConducts', GoodConductsController::class);

        // Penerimaan Siswa
        Route::resource('admissionLetters', AdmissionLettersController::class);

        // Kesalahan Penulisan Ijazah
        Route::resource('dataCorrections', DataCorrectionsController::class);

        // Umum (Siswa)
        Route::resource('generalLetters', GeneralLettersController::class);
        Route::get('/generalLetters/refstudents/search', [GeneralLettersController::class, 'search'])
        ->name('students.search');

    });

    // Surat Lain
    Route::prefix('others')->name('others.')->group(function () {

        // Pengembalian Ke orang Tua
        Route::resource('studentReturns', StudentReturnsController::class);
    });

});
