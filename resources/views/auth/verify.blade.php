@extends('layouts.app')
@section('title', 'Verifikasi Email')
@section('hero')
<div class="bg-white">
  <div class="hero">
    <div class="hero-inner">
      <div class="content content-full text-center">
        @if(session('resent'))
          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="alert alert-success" role="alert">
                {{ trans('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
              </div>
            </div>
          </div>
        @endif
        <h1 class="display-4 fw-bold text-black mb-3">{{ trans('Verifikasi alamat email Anda') }}</h1>
        <h2 class="fw-normal text-black-50 mb-0">{{ trans('Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.') }}</h2>
        <h2 class="fw-normal text-black-50 mb-2">{{ trans('Jika Anda tidak menerima email') }},</h2>
        <div>
          <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-hero btn-primary">{{ trans('Klik di sini untuk meminta email verifikasi anda') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
