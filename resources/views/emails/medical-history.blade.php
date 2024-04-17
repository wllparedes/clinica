@component('mail::message')
# <center> ¡Hola {{ $medicalHistory->medicalRequest->appointment->patient->full_name }}! </center>

Querido estimado, usted cuenta con recomendaciones y tratamiento. <br>

## Detalles del Doctor
- **Nombre:** {{ $medicalHistory->medicalRequest->doctor->full_name }}
- **Teléfono:** {{ $medicalHistory->medicalRequest->doctor->phone_number }}
- **Correo:** {{ $medicalHistory->medicalRequest->doctor->email }}

## Detalles del historial médico
- **ID:** {{ $medicalHistory->id }}
- **Peso:** {{ $medicalHistory->weight }} kg
- **Altura:** {{ $medicalHistory->height }} cm
- **Temperatura:** {{ $medicalHistory->temperature }} °C
- **Diagnóstico:** {{ $medicalHistory->diagnostic }}
- **Tratamiento:** {{ $medicalHistory->treatment }}
- **Medicación:** {{ $medicalHistory->medication }}
- **Síntomas:** {{ $medicalHistory->symptoms }}

@component('mail::button', ['url' => route('clinic.dashboard')])
    {{ __('Log in') }}
@endcomponent

<b>Gracias,</b> <br>
@endcomponent
