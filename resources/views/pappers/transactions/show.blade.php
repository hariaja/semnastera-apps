@extends('layouts.app')
@section('title') {{ trans('page.transactions.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 text-center fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.transactions.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.transactions.show') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('transactions.index') }}" class="btn btn-danger btn-sm"><i class="fa fa-sm fa-chevron-left me-2"></i>{{ trans('page.back') }}</a>
      </div>
    </div>
    <div class="block-content block-content-full">

      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="text-center">
            <h4>{{ trans('Detail Data Pembayaran') }}</h4>
          </div>
          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Nama') }}
              <span class="fw-semibold">{{ $transaction->user->first_name . " " . $transaction->user->last_name }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Jumlah Pembayaran') }}
              <span class="fw-semibold">{{ formatRupiah($transaction->amount) }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Tanggal Upload') }}
              <span class="fw-semibold">{{ customDate($transaction->upload_date) . " | " . $transaction->created_at->format('H:i') }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Status Pembayaran') }}
              <span class="fw-semibold text-uppercase">{{ $transaction->status }}</span>
            </li>
            @isset($transaction->reason)
              <li class="list-group-item d-flex justify-content-between text-center">
                <span>{{ trans('Alasan') }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between text-center">
                <span class="fw-semibold">{{ $transaction->reason }}</span>
              </li>
            @endisset
          </ul>

          @if(userRole() == App\Helpers\StatusConstant::ADMIN)
            <form action="{{ route('transactions.update', $transaction->code) }}" id="form-update" method="POST">
              @csrf
              @method('patch')

              <input type="hidden" name="code" id="code" value="{{ $transaction->code }}">

              <div class="mb-3">
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                  <option selected="selected" disabled>{{ trans('Ubah Status') }}</option>
                  <option value="Pending" {{ old('status', $transaction->status) == 'Pending' ? 'selected' : '' }}>{{ trans('Pending') }}</option>
                  <option value="Approved" {{ old('status', $transaction->status) == 'Approved' ? 'selected' : '' }}>{{ trans('Approved') }}</option>
                  <option value="Rejected" {{ old('status', $transaction->status) == 'Rejected' ? 'selected' : '' }}>{{ trans('Rejected') }}</option>
                </select>
                @error('status')
                  <div class="invalid-feedback"><b>{{ $message }}</b></div>
                @enderror
              </div>

              <div class="mb-3" id="reason-area">
                <label for="reason" class="form-label">{{ trans('Alasan') }} <em>(Jika Ditolak)</em></label>
                <textarea name="reason" id="reason" cols="30" rows="4" class="form-control @error('reason') is-invalid @enderror">{{ old('reason', $transaction->reason) }}</textarea>
                @error('reason')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <button type="button" class="btn btn-primary" id="update">{{ trans('page.edit') }}</button>
                <span id="loading-text">Loading</span>
              </div>

            </form>
          @endif

        </div>
        <div class="col-md-6">
          <h4 class="text-center">{{ trans('Bukti Pembayaran') }}</h4>
          <div class="animated fadeIn img-link img-link-zoom-in img-thumb img-lightbox">
            <img class="img-fluid img-center" src="{{ $transaction->getProof() }}" alt="">
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
@push('css')
<style>
  .img-center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
  }
</style>
@endpush
@push('javascript')

  <script>
    $(function () {
      $('#loading-text').hide()
      var status = $('#status').val()
      var reasonArea = document.getElementById('reason-area')
      if (status != 'Rejected') {
        reasonArea.style.display = 'none'
      } else {
        reasonArea.style.display = 'block'
      }
    })

    $('#status').on('change', function () {
      var status = $('#status').val()
      var reasonArea = document.getElementById('reason-area')
      if (status != 'Rejected') {
        reasonArea.style.display = 'none'
      } else {
        reasonArea.style.display = 'block'
      }
    })

    $('#update').click(function (e) {
      e.preventDefault()
      $('#update').prop('disabled', true)
      Swal.fire({
        icon: 'warning',
        title: 'Apakah Anda Yakin?',
        html: 'Dengan menekan tombol hapus, Maka <b>Semua Data</b> akan hilang!',
        showCancelButton: true,
        confirmButtonText: 'Ubah Data',
        cancelButtonText: 'Batalkan',
        cancelButtonColor: '#E74C3C',
        confirmButtonColor: '#3498DB'
      }).then((result) => {
        if (result.value) {
          let code = $('#code').val()
          let url = '/pappers/transactions/' + code

          $('#loading-text').show()
          
          $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            'status': $('#status').val(),
            'reason': $('#reason').val(),
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
  </script>


@endpush