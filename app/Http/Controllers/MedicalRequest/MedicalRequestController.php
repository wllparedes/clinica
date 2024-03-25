<?php

namespace App\Http\Controllers\MedicalRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin' || $user->role === 'super_admin') {
            return view('admin.medical-requests.index');
        } elseif ($user->role === 'patient') {
            return view('clinic.patient.medical-requests.index');
        } elseif ($user->role === 'receptionist') {
            return view('clinic.receptionist.medical-requests.index');
        } elseif ($user->role === 'doctor') {
            return view('clinic.doctor.medical-requests.index');
        }
    }
}
