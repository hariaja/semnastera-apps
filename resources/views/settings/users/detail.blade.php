@extends('layouts.app')
@section('title') {{ trans('page.users.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 text-center fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.users.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.users.show') }}
    </h3>
    <div class="block-options">
      <a href="{{ route('users.index') }}" class="btn btn-sm btn-danger"><i class="fa fa-sm fa-chevron-left me-2"></i>{{ trans('page.back') }}</a>
    </div>
  </div>
  <div class="block-content block-content-full">

    <div class="row justify-content-center">
      <div class="col-md-4">
        <ul class="nav-items push">
          <li>
            <div class="d-flex py-3">
              <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                <img class="img-avatar img-avatar48" src="{{ $user->getDefaultAvatar() }}" alt="">
              </div>
              <div class="flex-grow-1">
                <div class="fw-semibold">{{ $user->getUserFullNameLong() }}</div>
                <div class="fs-sm text-muted">{{ $user->isRole() }}</div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Email') }}
            <span class="fw-semibold">{{ $user->email }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Nomor Telepon') }}
            <span class="fw-semibold">{{ $user->phone }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Jenis Kelamin') }}
            <span class="fw-semibold">{{ $user->gender }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Bergabung Pada') }}
            <span class="fw-semibold">{{ customDate($user->created_at, true) }}</span>
          </li>
        </ul>
      </div>
      <div class="col-md-6">
        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Asal Institusi') }}
            <span class="fw-semibold">{{ $user->institution }}</span>
          </li>
          <li class="list-group-item align-items-center">
            <div class="text-center">{{ trans('Alamat') }}</div>
            <div class="fw-semibold text-center">{{ $user->address }}</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Jumlah Jurnal') }}
            <span class="fw-semibold">{{ $user->journals->count() }}</span>
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>
@endsection