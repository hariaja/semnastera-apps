@component('mail::message')
# Hello, {{ $transaction['name_user']}}

<hr>

Terimakasih sudah melakukan pembayaran. <br>
Pembayaran anda sedang diproses oleh tim {{ config('app.name') }}, silahkan bersabar dan menunggu konfirmasi dari Admin. <br>
Transaksi anda dibayarkan ke nomor rekening: {{ $transaction['no_rek'] }}, atas nama: {{ $transaction['bank_user_name'] }} dan nama bank: {{ $transaction['bank_name'] }} dengan jumlah sebesar {{ $transaction['amount'] }}.

<br>

Pesan ini dikirim secara otomatis, anda tidak perlu membalas atau mengirim kembali pesan dan cukup menunggu balasan dari kami.

@component('mail::button', ['url' => $transaction['url_details']])
Lihat Detail Pembayaran
@endcomponent

Terimakasih,<br>
Admin {{ config('app.name') }}
@endcomponent
