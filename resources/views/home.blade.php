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
      <table class="table table-bordered table-hover table-striped table-vcenter activities-table"></table>
    </div>

  </div>
</div>
@endsection
@push('javascript')
  <script>
    let activities_table
    $(function () {
      activities_table = $('.activities-table').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        responsive: true,
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [
          [5, 10, 20],
          [5, 10, 20]
        ],
        ajax: {
          url: '{{ route('home') }}'
        },
        columns: [
          {
            "title": "No.",
            "data": "DT_RowIndex",
            "searchable": false, 
            "sortable": false,
            "class": "text-center",
            "width": "10%"
          },
          {
            "name": "description",
            "title": "Deskripsi",
            "data": "description",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "created_at",
            "title": "Tanggal",
            "data": "created_at",
            "class": 'text-center',
            "searchable": false,
            "orderable": false,
          },
          {
            "name": "time",
            "title": "Jam",
            "data": "time",
            "class": 'text-center',
            "searchable": false,
            "orderable": false,
          },
        ],
      })
    })
  </script>
@endpush