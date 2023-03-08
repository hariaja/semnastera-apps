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
      {{ trans('page.revisions.index') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <div class="table-responsive p-1">
      <table class="table table-bordered table-hover table-striped table-vcenter revisions-table"></table>
    </div>

  </div>
</div>
@endsection
@push('javascript')
  <script>
    let revisions_table

    $(function () {
      revisions_table = $('.revisions-table').DataTable({
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
          url: '{{ route('revisions.index') }}'
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
            "name": "user",
            "title": "Revisi By",
            "data": "user",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "journal",
            "title": "Makalah",
            "data": "journal",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "batch",
            "title": "Batch",
            "data": "batch",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "action",
            "title": '<i class="fa fa-cog"></i>',
            "data": "action",
            "searchable": false, 
            "sortable": false,
            "class": "text-center",
            "width": "15%"
          }
        ],
      })
    })
  </script>
@endpush