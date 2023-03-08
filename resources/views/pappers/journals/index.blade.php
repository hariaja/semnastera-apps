@extends('layouts.app')
@section('title') {{ trans('page.journals.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 text-center fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.journals.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.journals.index') }}
      </h3>
    </div>
    <div class="block-content block-content-full">

      <div class="table-responsive p-1">
        <table class="table table-bordered table-hover table-striped table-vcenter journals-table"></table>
      </div>

    </div>
  </div>
@endsection
@push('javascript')
  <script>

    let journals_table

    $(function () {
      journals_table = $('.journals-table').DataTable({
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
          url: '{{ route('journals.index') }}'
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
            "title": "Pemakalah",
            "data": "user",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "title",
            "title": "Judul",
            "data": "title",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "category",
            "title": "Kategori",
            "data": "category",
            "class": 'text-center',
            "searchable": false,
            "orderable": false,
          },
          {
            "name": "upload_year",
            "title": "Tahun Upload",
            "data": "upload_year",
            "class": 'text-center',
            "searchable": false,
            "orderable": false,
          },
          {
            "name": "status",
            "title": "Status",
            "data": "status",
            "class": 'text-center',
            "searchable": false,
            "orderable": false,
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