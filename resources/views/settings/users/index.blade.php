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
        {{ trans('page.users.index') }}
      </h3>
    </div>
    <div class="block-content block-content-full">

      <div class="row">
        <div class="col-md-4">
          <div class="mb-3">
            <label for="status" class="form-label">{{ trans('Filter Status Pengguna') }}</label>
            <select type="text" class="form-select" name="status" id="status">
              <option selected>{{ trans('Semua Status') }}</option>
              <option value="1">{{ trans('Active') }}</option>
              <option value="0">{{ trans('Inactive') }}</option>
            </select>
          </div>
        </div>
      </div>

      <div class="table-responsive p-1">
        <table class="table table-bordered table-hover table-striped table-vcenter users-active-table"></table>
      </div>

    </div>
  </div>
@endsection
@push('javascript')
  @include('settings.users.script')
@endpush
