<?php

namespace App\Http\Controllers\MedicalRequest;

use App\Http\Controllers\Controller;
use App\Models\MedicalRequest;
use DateInterval;
use DateTime;
use Illuminate\Contracts\View\View;
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

                $start = new DateTime($appointment->date . ' ' . $appointment->time);
                $end = clone $start;
                $end->add(new DateInterval('PT1H'));

                $appointments[] = [
                    'id' => $appointment->id,
                    'title' => __('Appointment #') . $appointment->id,
                    'description' => getInfoAppointment($appointment->appointment->patient->full_name, $appointment->time),
                    'start' => $start->format('Y-m-d H:i:s'),
                    'end' => $end->format('Y-m-d H:i:s')
                ];
            }

            return view('clinic.doctor.medical-requests.index', compact('appointments'));
        }
    }


    public function show(MedicalRequest $medicalRequest): View
    {

        $medicalRequest->load('appointment', 'appointment.patient', 'doctor',);

        return view('clinic.doctor.medical-histories.index', compact('medicalRequest'));
    }
}
