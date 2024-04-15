@component('mail::message')
# <center> ¡Hola {{ $user }}! </center>

Querido estimado, usted cuenta con una cita médica para el dia de mañana. <br>

@component('mail::button', ['url' => route('clinic.dashboard')])
    {{ __('Log in') }}
@endcomponent

<b>Gracias,</b> <br>
@endcomponent
