<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Appointment\AppointmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'getCategories')->name('categories');
        Route::get('/subCategories/{category}', 'getSubCategories')->name('subCategories');
    });

    Route::controller(AppointmentController::class)->group(function () {
        Route::get('/appointments', 'getAppointments')->name('appointments');
        Route::get('/doctors', 'getDoctors')->name('doctors');
    });

});
