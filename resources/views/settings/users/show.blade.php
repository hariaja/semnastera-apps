@extends('layouts.app')
@section('title') {{ trans('Profil Saya') }} @endsection
@section('hero')
<div class="rounded border overflow-hidden push">
  <div class="bg-image pt-9" style="background-image: url('{{ asset('assets/dashmix/src/assets/media/photos/photo19@2x.jpg') }}');"></div>
  <div class="px-4 py-3 bg-body-extra-light d-flex flex-column flex-md-row align-items-center">
    <a class="d-block img-link mt-n5" href="">
      <img class="img-avatar img-avatar128 img-avatar-thumb" src="{{ userLogin()->getDefaultAvatar() }}" alt="">
    </a>
    <div class="ms-3 flex-grow-1 text-center text-md-start my-3 my-md-0">
      <h1 class="fs-4 fw-bold mb-1">{{ userLogin()->first_name . " " . userLogin()->last_name }}</h1>
      <h2 class="fs-sm fw-medium text-muted mb-0">
        {{ userRole() }}
      </h2>
    </div>
    <div class="space-x-1">
      <a href="{{ route('home') }}" class="btn btn-sm btn-alt-secondary space-x-1">
        <i class="fa fa-arrow-left opacity-50 me-1"></i>
        <span>{{ trans('Back to Dashboard') }}</span>
      </a>
    </div>
  </div>
</div>
@endsection
@section('content')
<div class="block block-bordered block-rounded">
  <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
    <li class="nav-item">
      <button class="nav-link space-x-1 active" id="account-profile-tab" data-bs-toggle="tab" data-bs-target="#account-profile" role="tab" aria-controls="account-profile" aria-selected="true">
        <i class="fa fa-user-circle d-sm-none"></i>
        <span class="d-none d-sm-inline">{{ trans('Profil') }}</span>
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link space-x-1" id="account-password-tab" data-bs-toggle="tab" data-bs-target="#account-password" role="tab" aria-controls="account-password" aria-selected="false">
        <i class="fa fa-asterisk d-sm-none"></i>
        <span class="d-none d-sm-inline">{{ trans('Password') }}</span>
      </button>
    </li>
  </ul>
  <div class="block-content tab-content">
    <div class="tab-pane active" id="account-profile" role="tabpanel" aria-labelledby="account-profile-tab" tabindex="0">
      <form action="{{ route('users.update', userLogin()->unique_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="row push p-sm-2 p-lg-4">
          <div class="col-xl-6 order-xl-0">

            <input type="hidden" name="status" value="{{ userLogin()->status }}">

            <div class="mb-4">
              <label class="form-label">{{ trans('page.image') }}</label>
              <div class="push">
                <img class="img-avatar img-prev" src="{{ userLogin()->getDefaultAvatar() }}" alt="">
              </div>
              <label class="form-label" for="image">{{ trans('Upload File') }}</label>
              <input type="hidden" name="oldImage" value="{{ userLogin()->avatar }}">
              <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
              @error('avatar')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
            
            <div class="mb-4">
              <label for="first_title" class="form-label">{{ trans('Gelar Depan') }}</label>
              <input type="text" name="first_title" id="first_title" value="{{ old('first_title', userLogin()->first_title) }}" class="form-control @error('first_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
              @error('first_title')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="first_title" class="form-label">{{ trans('Nama Depan') }}</label>
              <input type="text" name="first_name" id="first_name" value="{{ old('first_name', userLogin()->first_name) }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ trans('Nama Depan') }}" onkeypress="return hanyaHuruf(event)">
              @error('first_name')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="email" class="form-label">{{ trans('Email') }}</label>
              <input type="email" name="email" id="email" value="{{ old('email', userLogin()->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Email') }}">
              @error('email')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
              <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                <option selected="selected" disabled>{{ trans('Pilih Jenis Kelamin') }}</option>
                <option value="Laki - Laki" {{ old('gender', userLogin()->gender) == 'Laki - Laki' ? 'selected' : '' }}>{{ trans('Laki - Laki') }}</option>
                <option value="Perempuan" {{ old('gender', userLogin()->gender) == 'Perempuan' ? 'selected' : '' }}>{{ trans('Perempuan') }}</option>
              </select>
              @error('gender')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="address" class="form-label">{{ trans('Alamat Lengkap') }}</label>
              <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="40" rows="4" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address', userLogin()->address) }}</textarea>
              @error('address')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>

          </div>
  
          <div class="col-xl-6 order-xl-0">

            <div class="mb-4">
              <label for="last_title" class="form-label">{{ trans('Gelar Belakang') }}</label>
              <input type="text" name="last_title" id="last_title" value="{{ old('last_title', userLogin()->last_title) }}" class="form-control @error('last_title') is-invalid @enderror" placeholder="{{ trans('Gelar Belakang') }}" onkeypress="return hanyaHuruf(event)">
              @error('last_title')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="last_name" class="form-label">{{ trans('Nama Belakang') }}</label>
              <input type="text" name="last_name" id="last_name" value="{{ old('last_name', userLogin()->last_name) }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ trans('Nama Belakang') }}" onkeypress="return hanyaHuruf(event)">
              @error('last_name')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label" for="phone">{{ trans('Nomor Telepon') }}</label>
              <input type="text" name="phone" id="phone" value="{{ old('phone', userLogin()->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
              @error('phone')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label" for="institution">{{ trans('Asal Institusi') }}</label>
              <input type="text" name="institution" id="institution" value="{{ old('institution', userLogin()->institution) }}" class="form-control @error('institution') is-invalid @enderror" placeholder="{{ trans('Asal Institusi') }}" onkeypress="return hanyaHuruf(event)">
              @error('institution')
                <div class="invalid-feedback"><b>{{ $message }}</b></div>
              @enderror
            </div>
            <button type="submit" class="btn btn-alt-primary">
              <i class="fa fa-check-circle opacity-50 me-1"></i>
              {{ trans('page.edit') }}
            </button>
          </div>
        </div>

      </form>
    </div>
    <div class="tab-pane" id="account-password" role="tabpanel" aria-labelledby="account-password-tab" tabindex="0">
      <div class="row push p-sm-2 p-lg-4">
        <div class="offset-xl-1 col-xl-4 order-xl-1">
          <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
            {{ trans('Mengubah kata sandi masuk Anda adalah cara mudah untuk menjaga keamanan akun Anda.') }}
          </p>
        </div>
        <div class="col-xl-6 order-xl-0">
          <form action="{{ route('users.password') }}" method="POST">
            @csrf

            <div class="mb-4">
              <label class="form-label" for="current_password">Password Anda</label>
              <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
              @error('current_password')
                <span class="invalid-feedback">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="row mb-4">
              <div class="col-12">
                <label class="form-label" for="new_password">Password Baru</label>
                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                @error('new_password')
                  <span class="invalid-feedback">
                    {{ $message }}
                  </span>
                @enderror
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-12">
                <label class="form-label" for="new_confirm_password">Konfirmasi Password Baru</label>
                <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" id="new_confirm_password" name="new_confirm_password">
                @error('new_confirm_password')
                  <span class="invalid-feedback">
                    {{ $message }}
                  </span>
                @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-alt-primary">
              <i class="fa fa-check-circle opacity-50 me-2"></i>
              Update Password
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection