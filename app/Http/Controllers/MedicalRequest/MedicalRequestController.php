<?php

namespace App\Http\Controllers\MedicalRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'super_admin') {
            return view('admin.medical-requests.index');
        } elseif ($user->role === 'patient') {
            return view('clinic.patient.medical-requests.index');
        } elseif ($user->role === 'receptionist') {
            return view('clinic.receptionist.medical-requests.index');
        } elseif ($user->role === 'doctor') {

            $appointments = [];
            $allAppointments = $user->medicalRequests->where('status', 'approved');

            foreach ($allAppointments as $appointment) {
                $appointments[] = [
                    'id' => $appointment->id,
                    'title' => __('Appointment #') . $appointment->id,
                    'start' => $appointment->date . ' ' . $appointment->time,
                ];
            }

            return view('clinic.doctor.medical-requests.index', compact('appointments'));
        }
    }
}
