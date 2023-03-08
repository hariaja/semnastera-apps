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
        {{ trans('page.journals.show') }}
      </h3>
    </div>
    <div class="block-content block-content-full">

      <div class="text-center">
        <h4>{{ trans('page.journals.show') }}</h4>
      </div>

      <div class="row justify-content-center">
        <div class="col-xl-6">

          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Nama Pemakalah') }}
              <span class="fw-semibold">{{ $journal->user->getUserFullNameLong() }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Kategori') }}
              <span class="fw-semibold">{{ $journal->category }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Tanggal Upload') }}
              <span class="fw-semibold">{{ customDate($journal->created_at, true) }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Jam Upload') }}
              <span class="fw-semibold">{{ $journal->created_at->format('H:i:s') }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Status') }}
              <span class="fw-semibold badge bg-secondary">{{ $journal->status }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('File Makalah') }}
              <a href="{{ Storage::url($journal->file) }}" target="__blank">
                <span class="badge text-info">{{ trans('Lihat atau Download Disini') }}</span>
              </a>
            </li>
          </ul>

          @if(userRole() == 'Administrator' || userRole() == 'Reviewer')
          <form action="{{ route('journals.update', $journal->code) }}" id="form-update" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <input type="hidden" name="code" id="code" value="{{ $journal->code }}">

            <div class="mb-3">
              <label for="status" class="form-label">Ubah Status</label>
              <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                <option selected="selected" disabled>{{ trans('Ubah Status') }}</option>
                <option value="Pending" {{ old('status', $journal->status) == 'Pending' ? 'selected' : '' }}>{{ trans('Pending') }}</option>
                <option value="On Review" {{ old('status', $journal->status) == 'On Review' ? 'selected' : '' }}>{{ trans('On Review') }}</option>
                <option value="Final" {{ old('status', $journal->status) == 'Final' ? 'selected' : '' }}>{{ trans('Final') }}</option>
              </select>
              @error('status')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>

            <div class="mb-3">
              <button type="button" class="btn btn-primary" id="update">{{ trans('page.edit') }}</button>
            </div>

          </form>
        @endif

        </div>
        <div class="col-xl-6">
          <ul class="list-group push">
            {{-- Title --}}
            <li class="list-group-item text-center">
              <span class="text-center">{{ trans('Judul Makalah') }}</span>
            </li>
            <li class="list-group-item text-center">
              <span class="fw-semibold">{{ $journal->title }}</span>
            </li>
            {{-- Title --}}
            {{-- Abstract --}}
            <li class="list-group-item text-center">
              <span class="text-center">{{ trans('Abstract') }}</span>
            </li>
            <li class="list-group-item text-center">
              <span class="fw-semibold">{!! $journal->abstract !!}</span>
            </li>
            {{-- Abstract --}}
          </ul>
        </div>
      </div>

    </div>
  </div>
@endsection
@push('javascript')
  <script>
    $(function () {
      $('#update').click(function (e) {
        e.preventDefault()
        $('#update').prop('disabled', true)
        Swal.fire({
          icon: 'warning',
          title: 'Apakah Anda Yakin?',
          html: 'Dengan menekan tombol ubah, Maka <b>Data Jurnal</b> akan berubah!',
          showCancelButton: true,
          confirmButtonText: 'Ubah Data',
          cancelButtonText: 'Batalkan',
          cancelButtonColor: '#E74C3C',
          confirmButtonColor: '#3498DB'
        }).then((result) => {
          if (result.value) {
            
            let code = $('#code').val()
            let url = '/pappers/journals/' + code
            
            $.post(url, {
              '_token': $('[name=csrf-token]').attr('content'),
              'status': $('#status').val(),
              '_method': 'patch'
            }).done((response) => {
              location.reload()
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
            $('#loading-text').hide()
            $('#update').prop('disabled', false)
          }
        })
      })
    })
  </script>
@endpush