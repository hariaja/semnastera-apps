{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

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
              <span class="text-dark">{{ trans('Reset Password') }}</span>
            </div>
            <p class="fw-bold fs-sm text-muted">
              {{ trans('Masukkan email agar kami bisa menemukan akun anda') }}
            </p>
          </div>
          <!-- END Header -->

          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ trans('Email Address') }}">
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-3">
              <button type="submit" class="btn btn-primary btn-hero w-100">{{ __('Send Password Reset Link') }}</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection