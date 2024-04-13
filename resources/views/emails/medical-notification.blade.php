
# <center> ¡Hola {{ $user }}! </center>

<br>
Querido estimado, usted cuenta con una cita médica para el dia de mañana. <br>

{{-- @component('mail::button', ['url' => route('login'), 'color' => 'success'])
    Ingresa a tu cuenta
@endcomponent --}}

{{-- <center>
    ¿El link no funciona? Copia y pega esta URL en el navegador: <br>
    <a href="{{ route('login') }}"> {{ route('login') }} </a>
</center> --}}

<br>

<b>Gracias,</b> <br>
{{ config('app.name') }}
