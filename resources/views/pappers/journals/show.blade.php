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
        <div class="col-xl-10">

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
            {{-- Title --}}
            <li class="list-group-item text-center">
              <span class="text-center">{{ trans('Judul Makalah') }}</span>
            </li>
            <li class="list-group-item text-center">
              <span class="fw-semibold">{{ $journal->title }}</span>
            </li>
            {{-- Title --}}
          </ul>

          @if(userRole() == 'Administrator' || userRole() == 'Reviewer')
            <form action="{{ route('revisions.store') }}" id="form-update" method="POST" enctype="multipart/form-data">
              @csrf

              <input type="hidden" name="journal_id" id="journal_id" value="{{ $journal->id }}">
              <input type="hidden" name="revision_by" id="revision_by" value="{{ userLogin()->id }}">

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
                <label for="batch" class="form-label">Batch</label>
                <input type="text" name="batch" id="batch" class="form-control @error('batch') is-invalid @enderror" value="{{ old('batch') }}" placeholder="ex. Revisi 1 (Satu)">
                @error('batch')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="revision_file" class="form-label">{{ __('Upload File Revisi') }}</label>
                <input type="file" accept="application/pdf" name="revision_file" id="revision_file" class="form-control @error('revision_file') is-invalid @enderror">
                <small class="text-muted">{{ trans('Hanya boleh memasukkan file dengan format .pdf') }}</small>
                @error('revision_file')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-primary">{{ trans('page.edit') }}</button>
              </div>

            </form>
          @endif

          @if(userRole() == 'Pemakalah')
          <div class="table-responsive p-3">
            <input type="hidden" name="journal_code" id="journal_code" value="{{ $journal->code }}">
            <div class="mb-3">
              <h6>{{ trans('Detail Data Revisi') }}</h6>
            </div>
            <table class="table table-bordered table-hover table-striped table-vcenter journals-revisions-table"></table>
          </div>
          @endif

        </div>
      </div>

    </div>
  </div>
@endsection
@push('javascript')
  <script>
    let journals_revisions_table
    $(function () {
      var journal_code = $('#journal_code').val()
      var url = '/journals/journals/' + journal_code
      journals_revisions_table = $('.journals-revisions-table').DataTable({
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
          url: url
        },
        columns: [
          {
            "title": "Batch",
            "data": "batch",
            "searchable": true, 
            "sortable": true,
            "class": "text-center",
          },
          {
            "title": "Direvisi Oleh",
            "data": "revision_by",
            "searchable": false, 
            "sortable": false,
            "class": "text-center",
          },
          {
            "title": "File Revisi",
            "data": "revision_file",
            "searchable": false, 
            "sortable": false,
            "class": "text-center",
          }
        ],
      })
    })
  </script>
@endpush