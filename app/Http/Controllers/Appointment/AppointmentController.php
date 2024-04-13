<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin' || $user->role === 'super_admin') {
            return view('admin.appointments.index');
        } elseif ($user->role === 'patient') {
            return view('clinic.patient.appointments.index');
        } elseif ($user->role === 'receptionist') {
            return view('clinic.receptionist.appointments.index');
        }
    }

    public function getAppointments(Request $request): Collection
    {
        if ($request->ajax()) {
            return AppointmentRequest::where('status', 'pending')->doesntHave('medicalRequest')->get();
        }

        abort(403, 'Access denied');
    }

    public function getDoctors(Request $request): Collection
    {

        if ($request->ajax()) {
            return User::where('role', 'doctor')->where('available', 1)->where('status', 1)->get();
        }

        abort(403, 'Access denied');
    }
}
