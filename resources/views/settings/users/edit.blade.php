@extends('layouts.app')
@section('title') {{ trans('page.users.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 text-center fw-semibold my-2 my-sm-3">{{ trans('page.users.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.users.edit') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-danger"><i class="fa fa-sm fa-chevron-left me-2"></i>{{ trans('page.back') }}</a>
      </div>
    </div>
    <div class="block-content block-content-full">

      <form action="{{ route('users.update', $user->unique_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')

        @if(userRole() == App\Helpers\StatusConstant::ADMIN)
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="status" class="form-label">{{ trans('Status Pengguna') }}</label>
                <select type="text" class="form-select" name="status" id="status">
                  <option disabled selected>{{ trans('Pilih Status') }}</option>
                  <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>{{ trans('Active') }}</option>
                  <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>{{ trans('Inactive') }}</option>
                </select>
              </div>
            </div>
          </div>
        @endif

        <div class="row">
          <div class="col-md-2">
            <div class="mb-4">
              <label for="first_title" class="form-label">{{ trans('Gelar Depan') }}</label>
              <input type="text" name="first_title" id="first_title" value="{{ old('first_title', $user->first_title) }}" class="form-control @error('first_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
              @error('first_title')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-4">
              <label for="first_title" class="form-label">{{ trans('Nama Depan') }}</label>
              <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ trans('Nama Depan') }}" onkeypress="return hanyaHuruf(event)">
              @error('first_name')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-4">
              <label for="last_name" class="form-label">{{ trans('Nama Belakang') }}</label>
              <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ trans('Nama Belakang') }}" onkeypress="return hanyaHuruf(event)">
              @error('last_name')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
          <div class="col-md-2">
            <div class="mb-4">
              <label for="last_title" class="form-label">{{ trans('Gelar Belakang') }}</label>
              <input type="text" name="last_title" id="last_title" value="{{ old('last_title', $user->last_title) }}" class="form-control @error('last_title') is-invalid @enderror" placeholder="{{ trans('Gelar Belakang') }}" onkeypress="return hanyaHuruf(event)">
              @error('last_title')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
              <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                <option selected="selected" disabled>{{ trans('Pilih Jenis Kelamin') }}</option>
                <option value="Laki - Laki" {{ old('gender', $user->gender) == 'Laki - Laki' ? 'selected' : '' }}>{{ trans('Laki - Laki') }}</option>
                <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>{{ trans('Perempuan') }}</option>
              </select>
              @error('gender')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label" for="institution">{{ trans('Asal Institusi') }}</label>
              <input type="text" name="institution" id="institution" value="{{ old('institution', $user->institution) }}" class="form-control @error('institution') is-invalid @enderror" placeholder="{{ trans('Asal Institusi') }}" onkeypress="return hanyaHuruf(event)">
              @error('institution')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md">
            <div class="mb-4">
              <label for="email" class="form-label">{{ trans('Email') }}</label>
              <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Email') }}">
              @error('email')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
          <div class="col-md">
            <div class="mb-4">
              <label class="form-label" for="phone">{{ trans('Nomor Telepon') }}</label>
              <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
              @error('phone')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <label for="address" class="form-label">{{ trans('Alamat Lengkap') }}</label>
              <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="40" rows="4" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address', $user->address) }}</textarea>
              @error('address')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label">{{ trans('page.image') }}</label>
              <div class="push">
                <img class="img-avatar img-prev" src="{{ $user->getDefaultAvatar() }}" alt="">
              </div>
              <label class="form-label" for="image">{{ trans('Upload File') }}</label>
              <input type="hidden" name="oldImage" value="{{ $user->avatar }}">
              <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
              @error('avatar')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary w-100 btn-hero">
              <i class="fa fa-check-circle opacity-50 me-1"></i>
              {{ trans('page.edit') }}
            </button>
          </div>
        </div>

      </form>

    </div>
  </div>
@endsection