@extends('layouts.app')
@section('title') {{ trans('page.overview.title') }} @endsection
@section('hero')
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 text-center fs-3 fw-semibold my-2 my-sm-3">{{ trans('Dashboard') }}</h1>
      </div>
    </div>
  </div>
@endsection
@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <div class="row items-push">
      <div class="col-sm-6 col-xl">
        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0 bg-gd-sea-op">
          <div class="block-content block-content-full flex-grow-1">
            <div class="item rounded-3 bg-body mx-auto my-3">
              <i class="fa fa-file-pdf fa-lg text-primary"></i>
            </div>
            <div class="fs-1 fw-bold text-white">{{ reviewerCount() }}</div>
            <div class="text-muted mb-3 text-white">{{ trans('Total Reviewer') }}</div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl">
        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0 bg-gd-lake-op">
          <div class="block-content block-content-full flex-grow-1">
            <div class="item rounded-3 bg-body mx-auto my-3">
              <i class="fa fa-users fa-lg text-primary"></i>
            </div>
            <div class="fs-1 fw-bold text-white">{{ presenterCount() }}</div>
            <div class="text-muted mb-3 text-white">{{ trans('Total Pemakalah') }}</div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl">
        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0 bg-gd-fruit">
          <div class="block-content block-content-full flex-grow-1">
            <div class="item rounded-3 bg-body mx-auto my-3">
              <i class="fa fa-handshake-alt fa-lg text-primary"></i>
            </div>
            <div class="fs-1 fw-bold text-white">{{ participantCount() }}</div>
            <div class="text-muted mb-3 text-white">{{ trans('Total Peserta') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('My Last Activity') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <div class="table-responsive p-1">
      <table class="table table-bordered table-hover table-striped table-vcenter">
        <thead>
          <tr>
            <th class="text-center">Deskripsi</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Jam</th>
          </tr>
        </thead>
        <tbody>
          @forelse (myActivity() as $data)
            <tr>
              <td class="text-center">{{ $data->description }}</td>
              <td class="text-center">{{ customDate($data->created_at, true) }}</td>
              <td class="text-center">{{ $data->created_at->format('H:i:s') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center"><strong>Tidak Ada Aktivitas</strong></td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection