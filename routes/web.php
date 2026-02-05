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
        Route::get('/travelOrders/employees/search', [TravelOrdersController::class, 'search'])
            ->name('employees.search');
        Route::get('/travelOrders/preview/{id}', [TravelOrdersController::class, 'preview'])->name('travelOrders.preview');
        Route::post('/travelOrders/{id}/increment-download', [TravelOrdersController::class, 'incrementDownload'])
            ->name('travelOrders.increment-download');
    });


    // Surat Undangan
    Route::prefix('su')->name('su.')->group(function () {

        // Orang Tua
        Route::resource('parentInvitations', ParentInvitationController::class);
        Route::get('parentInvitations/{id}/preview', [ParentInvitationController::class, 'preview'])
            ->name('parentInvitations.preview');
        Route::get('parentInvitations/students/search', [ParentInvitationController::class, 'search'])
            ->name('students.search');
        Route::get('parentInvitations/{id}/preview', [ParentInvitationController::class, 'preview'])
            ->name('parentInvitation.print');
        Route::post('parentInvitation/{id}/increment-download', [TravelOrdersController::class, 'incrementDownload'])
            ->name('parentInvitations.increment-download');
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
        Route::get('/dataCorrections/refstudents/search', [DataCorrectionsController::class, 'search'])
            ->name('student.search');
        Route::get('/class/detail/{id}', [DataCorrectionsController::class, 'getClassDetail'])
            ->name('class.detail');
        Route::get('/sk/student/detail/{id}', [DataCorrectionsController::class, 'getStudentDetail'])
            ->name('student.detail');
        Route::get('/dataCorrections/preview/{id}', [DataCorrectionsController::class, 'preview'])->name('dataCorrections.preview');
        Route::post('/dataCorrections/{id}/increment-download', [DataCorrectionsController::class, 'incrementDownload'])
            ->name('dataCorrections.increment-download');

        // Umum (Siswa)
        Route::resource('generalLetters', GeneralLettersController::class);
        Route::get('/generalLetters/refstudents/search', [GeneralLettersController::class, 'search'])
            ->name('students.search');
        Route::get('/generalLetters/preview/{id}', [GeneralLettersController::class, 'preview'])->name('generalLetters.preview');
        Route::post('/generalLetter/{id}/increment-download', [GeneralLettersController::class, 'incrementDownload'])
            ->name('generalLetters.increment-download');
    });

    // Surat Lain
    Route::prefix('others')->name('others.')->group(function () {

        // Pengembalian Ke orang Tua
        Route::resource('studentReturns', StudentReturnsController::class);
    });
});
