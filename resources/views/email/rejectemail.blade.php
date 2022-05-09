@component('mail::message')
# Permintaan anda telah ditolak!<br>
Sila kemas kini dokumen anda seperti komen berikut menggunakan kata laluan sementara yang diberikan: <br>

<pre>{{ $comment }}</pre><br>

Email : {{$email}} <br>
Password: {{$password}}

Terima kasih<br>
@endcomponent
