@extends('layouts.app')
@section('title') {{ trans('page.registrations.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 text-center fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.registrations.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.registrations.create') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('registrations.index') }}" class="btn btn-danger btn-sm"><i class="fa fa-sm fa-chevron-left me-2"></i>{{ trans('page.back') }}</a>
      </div>
    </div>
    <div class="block-content block-content-full">

      <form action="{{ route('registrations.store') }}" method="POST">
        @csrf

        <div class="row">
          <div class="col-md">
            <div class="mb-3">
              <label class="form-label" for="title">{{ trans('Judul') }} <i>{{ trans('Opsional') }}</i></label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}" placeholder="{{ trans('Judul') }}">
              @error('title')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
          <div class="col-md">
            <div class="mb-3">
              <label class="form-label" for="date_start">{{ trans('Tanggal Dibuka') }}</label>
              <input type="date" class="form-control @error('date_start') is-invalid @enderror" name="date_start" id="date_start" value="{{ old('date_start') }}" placeholder="{{ trans('Y-m-d') }}">
              @error('date_start')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md">
            <div class="mb-3">
              <label class="form-label" for="date_end">{{ trans('Tanggal Ditutup') }}</label>
              <input type="text" class="form-control @error('date_end') is-invalid @enderror" name="date_end" id="date_end" value="{{ old('date_end') }}" placeholder="{{ trans('Y-m-d') }}" readonly>
              @error('date_end')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
          <div class="col-md">
            <div class="mb-3">
              <label class="form-label" for="status">{{ trans('Status') }}</label>
              <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                <option selected="selected" disabled>{{ trans('Pilih Status') }}</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ trans('Active') }}</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ trans('Inactive') }}</option>
              </select>
              @error('status')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-primary">{{ trans('page.create') }}</button>
        </div>

      </form>

    </div>
  </div>
@endsection
@push('javascript')
  <script>
    $(function () {
      var today = new Date()

      var month = today.getMonth() + 1
      var day = today.getDate()
      var year = today.getFullYear()

      if(month < 10)
        month = '0' + month.toString()
      if(day < 10)
        day = '0' + day.toString()

      var maxDate = year + '-' + month + '-' + day

      // or instead:
      // var maxDate = dtToday.toISOString().substr(0, 10)

      $('#date_start').attr('min', maxDate)

      $('#date_start').on('change', function () {
        var getDate = $(this).val()

        var firstDay = new Date(getDate)
        var nextWeek = new Date(firstDay.getTime() + 7 * 24 * 60 * 60 * 1000)

        var twoDigitMonth = nextWeek.getMonth() + 1
        var twoDigitDate = nextWeek.getDate()

        if (twoDigitMonth < 10) twoDigitMonth = "0" + twoDigitMonth.toString()
        if (twoDigitDate < 10) twoDigitDate = "0" + twoDigitDate.toString()

        var formatDate = nextWeek.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDate

        $('#date_end').val(formatDate)

      })
    })
  </script>
@endpush