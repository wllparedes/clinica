<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\MedicalRequest\MedicalRequestController;
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

            Route::get('/products', function () {
                return view('admin.products.index');
            })->name('products');
        });
    });

    // CLINIC

    Route::group(['prefix' => 'clinic', 'as' => 'clinic.'], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::middleware(['check.role:patient,receptionist'])->group(function () {
            Route::controller(AppointmentController::class)->group(function () {
                Route::get('/appointments', 'index')->name('appointments');
                Route::get('/appointments-all', 'getAppointments')->name('appointment.all');
                Route::get('/doctors-all', 'getDoctors')->name('doctor.all');
            });
        });

        Route::middleware(['check.role:doctor,patient,receptionist'])->group(function () {
            Route::get('/medical-requests', [MedicalRequestController::class, 'index'])->name('medical-requests');
        });
    });
});
