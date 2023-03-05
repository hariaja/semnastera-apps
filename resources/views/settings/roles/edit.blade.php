@extends('layouts.app')
@section('title') {{ trans('page.roles.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 text-center fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.roles.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.roles.edit') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-danger"><i class="fa fa-chevron-left fa-xs me-2"></i>{{ trans('page.back') }}</a>
      </div>
    </div>
    <div class="block-content block-content-full">

      <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('patch')

        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label" for="name">{{ trans('Nama Peran') }}</label>
              <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Nama Peran Pengguna') }}" onkeypress="return hanyaHuruf(event)">
              @error('name')
                <div class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="mb-3">
          <div class="space-y-2">
            <div class="form-check">
              <input type="checkbox" name="all_permission" id="all_permission" class="form-check-input @error('permission') is-invalid @enderror">
              <label for="all_permission" class="form-check-label">{{ trans('Pilih Semua Hak Akses') }}</label>
              @error('permission')
                <div class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          @foreach ($permissions as $data)
            <div class="col-md-4">
              <div class="card push">
                <div class="card-header border-bottom-0">
                  <h6 class="block-title">{{ trans('permission.' . $data->name) }}</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      @foreach ($data->permissions as $item)
                        <div class="space-y-2">
                          <div class="form-check">
                            <input class="permission form-check-input @error('permission') is-invalid @enderror" name="permission[{{ $item->name }}]" id="permission" type="checkbox" value="{{ $item->name }}" {{ in_array($item->name, $rolePermissions) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission">{{ trans('permission.' . $item->name) }}</label>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
  
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">{{ trans('page.edit') }}</button>
        </div>

      </form>

    </div>
  </div>
@endsection
@push('javascript')
<script type="text/javascript">
  $(document).ready(function() {
    $('[name="all_permission"]').on('click', function() {
      if($(this).is(':checked')) {
        $.each($('.permission'), function() {
          $(this).prop('checked', true);
        });
      } else {
        $.each($('.permission'), function() {
          $(this).prop('checked', false);
        });
      }
    });
  });
</script>
@endpush