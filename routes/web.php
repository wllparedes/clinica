<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// LOGIN

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    // ADMIN

    Route::middleware(['check.role:admin,super_admin'])->group(function () {

        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

            Route::get('/dashboard', function () {
                return view('admin.common.home.dashboard');
            })->name('dashboard');

            Route::get('/staff', function () {
                return view('admin.staff.index');
            })->name('staff');

            Route::get('/patients', function () {
                return view('admin.patients.index');
            })->name('patients');
        });
    });

    // PATIENTS

    Route::middleware(['check.role:patient'])->group(function () {


        Route::get('/patient/dashboard', function () {
            return view('clinic.common.home.dashboard');
        })->name('patient.dashboard');


        Route::get('/patient/appointments', function () {
            return view('clinic.patient.appointments.index');
        })->name('patient.appointments');
    });

    // DOCTORS

    Route::middleware(['check.role:doctor'])->group(function () {

        Route::get('/doctor/dashboard', function () {
            return view('clinic.common.home.dashboard');
        })->name('doctor.dashboard');

        Route::get('/doctor/appointments', function () {
            return view('clinic.patient.appointments.index');
        })->name('doctor.appointments');
    });
});
