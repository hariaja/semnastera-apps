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
        {{ trans('page.registrations.index') }}
      </h3>
    </div>
    <div class="block-content block-content-full">

      @can('registrations.create')
        <div class="mb-3">
          <a href="{{ route('registrations.create') }}" class="btn btn-primary"><i class="fa fa-plus fa-xs me-2"></i>{{ trans('page.registrations.create') }}</a>
        </div>
      @endcan

      <div class="table-responsive p-1">
        <table class="table table-bordered table-hover table-striped table-vcenter registrations-table"></table>
      </div>

    </div>
  </div>
@endsection
@push('javascript')
  <script>
    // Define Role Table Variable
    let registrations_table

    function cekRoles() {
      var role = '{{ auth()->user()->roles->implode('name') }}'
      if (role == "Administrator") {
        return true
      } else {
        return false
      }
    }

    $(function () {
      registrations_table = $('.registrations-table').DataTable({
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
          url: '{{ route('registrations.index') }}'
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
            "name": "title",
            "title": "Title",
            "data": "title",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "date_start",
            "title": "Tanggal Buka",
            "data": "date_start",
            "class": 'text-center',
            "searchable": false,
            "orderable": false,
          },
          {
            "name": "date_end",
            "title": "Tanggal Tutup",
            "data": "date_end",
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
            "width": "15%",
            "visible": cekRoles()
          }
        ],
      })
    })

    function deleteRegistration(url) {
      Swal.fire({
        icon: 'warning',
        title: "Apakah Anda Yakin?",
        html: "Dengan menekan tombol hapus, Maka <b>Semua Data</b> akan hilang!",
        showCancelButton: true,
        confirmButtonText: 'Hapus Data',
        cancelButtonText: 'Batalkan',
        cancelButtonColor: '#E74C3C',
        confirmButtonColor: '#3498DB'
      }).then((result) => {
        if (result.value) {
          $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete'
          })
          .done((response) => {
            Swal.fire({
              icon: 'success',
              title: response.message,
              confirmButtonText: 'Selesai'
            })
            registrations_table.ajax.reload()
          })
          .fail((errors) => {
            Swal.fire({
              icon: 'error',
              title: errors.responseJSON.message,
              confirmButtonText: 'Mengerti'
            })
            return
          })
        } else if (result.dismiss == swal.DismissReason.cancel) {
          Swal.fire({
            icon: 'error',
            title: 'Dibatalkan',
            text: 'Tidak ada perubahan disimpan',
            showConfirmButton: 'Ok',
            customClass: {
              confirmButton: 'btn btn-indigo',
            }
          })
        }
      })
    }
  </script>
@endpush