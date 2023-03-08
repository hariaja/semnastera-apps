@extends('layouts.app')
@section('title') {{ trans('page.revisions.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 text-center fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.revisions.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.revisions.show') }}
    </h3>
    <div class="block-options">
      <a href="{{ route('revisions.index') }}" class="btn btn-danger btn-sm"><i class="fa fa-chevron-left fa-sm me-2"></i>{{ trans('page.back') }}</a>
    </div>
  </div>
  <div class="block-content block-content-full">

    <div class="text-center">
      <h4>{{ trans('page.revisions.show') }}</h4>
    </div>

    <div class="row justify-content-center">
      <div class="col-xl-6">

        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Nama Perevisi') }}
            <span class="fw-semibold">{{ $revision->user->getUserFullNameLong() }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Role') }}
            <span class="fw-semibold">{{ $revision->user->isRole() }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Batch') }}
            <span class="fw-semibold">{{ $revision->batch }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Direvisi Pada') }}
            <span class="fw-semibold">{{ customDate($revision->created_at, true) }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Jam Upload') }}
            <span class="fw-semibold">{{ $revision->created_at->format('H:i:s') }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('File Makalah') }}
            <a href="{{ Storage::url($revision->journal->file) }}" target="__blank">
              <span class="badge text-info">{{ trans('Lihat atau Download Disini') }}</span>
            </a>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('File Revisi') }}
            <a href="{{ Storage::url($revision->revision_file) }}" target="__blank">
              <span class="badge text-info">{{ trans('Lihat atau Download Disini') }}</span>
            </a>
          </li>
        </ul>

      </div>
    </div>

  </div>
</div>
@endsection