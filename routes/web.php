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

            Route::get('/appointments', function () {
                return view('admin.appointments.index');
            })->name('appointments');

            Route::get('/medical-requests', function () {
                return view('admin.medical-requests.index');
            })->name('medical-requests');
        });
    });

    // PATIENTS

    Route::middleware(['check.role:patient'])->group(function () {


        Route::get('/patient/dashboard', function () {
            return view('clinic.common.home.dashboard');
        })->name('dashboard');


        Route::get('/patient/appointments', function () {
            return view('clinic.patient.appointments.index');
        })->name('appointments');
    });

    // DOCTORS

    Route::middleware(['check.role:doctor'])->group(function () {

        Route::group(['prefix' => 'doctor'], function () {

            Route::get('/dashboard', function () {
                return view('clinic.common.home.dashboard');
            })->name('dashboard');

            Route::get('/medical-requests', function () {
                return view('clinic.doctor.medical-requests.index');
            })->name('medical-requests');
        });
    });

    // RECEPTIONIST

    Route::middleware(['check.role:receptionist'])->group(function () {

        Route::group(['prefix' => 'receptionist'], function () {

            Route::get('/dashboard', function () {
                return view('clinic.common.home.dashboard');
            })->name('dashboard');

            Route::get('/appointments', function () {
                return view('clinic.receptionist.appointments.index');
            })->name('appointments');

        });

    });
});
