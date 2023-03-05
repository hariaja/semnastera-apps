@component('mail::message')
# Hello, {{ $transaction['name_user']}}

<hr>

Sebelumnya kami meminta maaf, data atau bukti pembayaran yang anda kirimkan tidak sesuai atau tidak valid. <br>
Mohon untuk mengunggah bukti pembayaran yang valid berdasarkan pembayaran yang sudah anda lakukan. <br>

<br>
<br>

Pesan ini dikirim secara otomatis, anda tidak perlu membalas atau mengirim kembali pesan dan cukup menunggu balasan dari kami.

@component('mail::button', ['url' => $transaction['url_details']])
Lihat Detail Pembayaran
@endcomponent

Terimakasih,<br>
Admin {{ config('app.name') }}
@endcomponent