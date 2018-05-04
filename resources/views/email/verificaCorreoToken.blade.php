@component('mail::message')
# Hola! Para verificar tu correo

@component('mail::button', ['url' => route('enviarCorreoListo',['correo' => $seller['correo'], 'emailtoken' => $seller['emailtoken'] ])])
DA CLICK AQUI!
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
