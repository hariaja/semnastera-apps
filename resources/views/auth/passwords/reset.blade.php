@extends('layouts.guest')
@section('title', 'Reset Password')
@section('content')

<div class="bg-image" style="background-image: url('{{ asset('assets/dashmix/src/assets/media/photos/photo19@2x.jpg') }}')">
  <div class="row g-0 justify-content-center bg-primary-dark-op">
    <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
      <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
          <!-- Header -->
          <div class="mb-2 text-center">
            <div class="link-fx fw-bold fs-1">
              <span class="text-dark">{{ trans('Kata Sandi Baru') }}</span>
            </div>
            <p class="fw-bold fs-sm text-muted">
              {{ trans('Buat kata sandi baru anda. Buat kata sandi yang unik.') }}
            </p>
          </div>
          <!-- END Header -->

          <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
              <label for="email" class="form-label">{{ __('Email Address') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">{{ __('Password') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="mb-0">
              <button type="submit" class="btn btn-primary btn-hero w-100">{{ __('Reset Password') }}</button>
            </div>
        </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
