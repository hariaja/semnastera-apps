@component('mail::message')
# Hello, {{ $transaction['name_user']}}

<hr>

Horaaay!!! <br>
Sepertinya anda sudah melakukan pembayaran dan tim kami sudah menerima bukti pembayaran yang anda lakukan. <br>
Silahkan untuk mengupload jurnal anda dan tim reviewer akan membantu anda hingga jurnal anda siap publish di acara {{ config('app.name') }} yang akan segera dilaksanakan.

<br>
<br>

Pesan ini dikirim secara otomatis, anda tidak perlu membalas atau mengirim kembali pesan dan cukup menunggu balasan dari kami.

@component('mail::button', ['url' => $transaction['url_details']])
Lihat Detail Pembayaran
@endcomponent

Terimakasih,<br>
Admin {{ config('app.name') }}
@endcomponent