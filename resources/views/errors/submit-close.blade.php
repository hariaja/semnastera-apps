@extends('layouts.errors')
@section('title') {{ trans('page.transactions.title') }} @endsection
@section('main')
<div class="hero-static col-md-5 d-flex flex-column bg-body-extra-light">
  <!-- Header -->
  <div class="flex-grow-0 p-5">
    <a class="link-fx fw-bold fs-2" href="index.html">
      <span class="text-dark">{{ config('app.name') }}</span>
    </a>
  </div>
  <!-- END Header -->

  <!-- Content -->
  <div class="flex-grow-1 d-flex align-items-center p-5 bg-body-light">
    <div class="w-100">
      <h1 class="fw-bold mb-2">
        {{ trans('Submit Papper Telah Ditutup') }}
      </h1>
      <p class="fs-4 fw-medium text-muted mb-5">
        {{ trans('Silahkan kembali setelah pendaftaran dibuka.') }}
      </p>
      <a class="btn btn-lg btn-alt-danger" href="{{ route('home') }}">
        <i class="fa fa-sm fa-chevron-left opacity-50 me-1"></i>
        {{ trans('Kembali ke Dashboard') }}
      </a>
    </div>
  </div>
  <!-- END Content -->

  <!-- Footer -->
  <ul class="list-inline flex-gow-1 p-5 fs-sm fw-medium mb-0">
    <li class="list-inline-item">
      <a class="text-muted" href="{{ route('home') }}">
        {{ trans('page.overview.title') }}
      </a>
    </li>
  </ul>
  <!-- END Footer -->
</div>
@endsection