@extends('layouts.guest')
@section('title', 'Buat Akun Baru')
@section('content')
<div class="bg-image" style="background-image: url('{{ asset('assets/dashmix/src/assets/media/photos/photo19@2x.jpg') }}')">
  <div class="row g-0 justify-content-center bg-primary-dark-op">
    <div class="hero-static col-sm-8 col-md-6 col-xl-10 d-flex align-items-center p-2 px-sm-0">
      <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">

          <!-- Header -->
          <div class="mb-2 text-center">
            <div class="link-fx fw-bold fs-1">
              <span class="text-dark">{{ trans('New Users Register') }}</span>
            </div>
            <p class="fw-bold fs-sm text-muted">
              {{ trans('Buat Akun Baru') }}
            </p>
          </div>
          <!-- END Header -->
      
          <!-- Sign Up Form -->
          <form class="js-validation-signup" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="row">
              <div class="col-md-2">
                <div class="mb-2">
                  <input type="text" name="first_title" id="first_title" value="{{ old('first_title') }}" class="form-control @error('first_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
                  @error('first_title')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-2">
                  <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ trans('Nama Depan') }}" onkeypress="return hanyaHuruf(event)">
                  @error('first_name')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-2">
                  <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ trans('Nama Belakang') }}" onkeypress="return hanyaHuruf(event)">
                  @error('last_name')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
              <div class="col-md-2">
                <div class="mb-2">
                  <input type="text" name="last_title" id="last_title" value="{{ old('last_title') }}" class="form-control @error('last_title') is-invalid @enderror" placeholder="{{ trans('Gelar Belakang') }}" onkeypress="return hanyaHuruf(event)">
                  @error('last_title')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="mb-4">
                  <span class="text-muted fw-semibold">{{ trans('Kosongkan jika tidak atau belum memiliki gelar') }}</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                    <option selected="selected" disabled>{{ trans('Pilih Jenis Kelamin') }}</option>
                    <option value="Laki - Laki" {{ old('gender') == 'Laki - Laki' ? 'selected' : '' }}>{{ trans('Laki - Laki') }}</option>
                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>{{ trans('Perempuan') }}</option>
                  </select>
                  @error('gender')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
              <div class="col-md-8">
                <div class="mb-3">
                  <input type="text" name="institution" id="institution" value="{{ old('institution') }}" class="form-control @error('institution') is-invalid @enderror" placeholder="{{ trans('Asal Institusi') }}" onkeypress="return hanyaHuruf(event)">
                  @error('institution')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <div class="mb-3">
                  <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="40" rows="4" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address') }}</textarea>
                  @error('address')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
                  @error('phone')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>

                <div class="mb-3">
                  <select name="roles" id="roles" class="form-select @error('roles') is-invalid @enderror">
                    <option disabled selected>{{ trans('Tipe User') }}</option>
                    @foreach ($roles as $item)
                      @if (old('roles') == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                      @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  @error('roles')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="mb-3">
                  <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Email') }}">
                  @error('email')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
              <div class="col-md">
                <div class="mb-3">
                  <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="{{ trans('Password') }}">
                  @error('password')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
              <div class="col-md">
                <div class="mb-3">
                  <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ trans('Ulangi Password') }}">
                  @error('password_confirmation')
                    <div class="invalid-feedback"><b>{{ $message }}</b></div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="text-center m-4">
              <button type="submit" class="btn btn-hero btn-primary">
                <i class="fa fa-fw fa-plus opacity-50 me-1"></i>
                {{ trans('Daftar Sekarang') }}
              </button>
            </div>
            <div class="text-center">
              {{ trans('Sudah punya akun?') }}
              <a href="{{ route('login') }}"><b>{{ trans('Masuk Aplikasi') }}</b></a>
            </div>
          </form>
          <!-- END Sign Up Form -->

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('javascript')
  <script>
    $(document).ready(function () {

      $('#provinces').on('change', function () {
        var province_id = $(this).val()
        if (province_id) {
          $.ajax({
            url: 'provinces/regencies/' + province_id,
            type: 'GET',
            data : {
              "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (data) {
              if (data) {
                $('#regencies').empty()
                $('#regencies').append('<option disabled>Pilih Kota atau Kabupaten</option>')
                $.each(data, function(key, regencies) {
                  $('select[name="regencies"]').append('<option value="'+ regencies.id +'">' + regencies.name + '</option>')
                })
              } else {
                $('#regencies').empty()
              }
            }
          })
        } else {
          $('#regencies').empty()
        }
      })

      $('#regencies').on('change', function () {
        var regency_id = $(this).val()
        if (regency_id) {
          $.ajax({
            url: 'provinces/districts/' + regency_id,
            type: 'GET',
            data : {
              "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (data) {
              if (data) {
                $('#districts').empty()
                $('#districts').append('<option disabled>Pilih Kecamatan</option>')
                $.each(data, function(key, districts) {
                  $('select[name="districts"]').append('<option value="'+ districts.id +'">' + districts.name + '</option>')
                })
              } else {
                $('#districts').empty()
              }
            }
          })
        } else {
          $('#districts').empty()
        }
      })

      $('#districts').on('change', function () {
        var district_id = $(this).val()
        if (district_id) {
          $.ajax({
            url: 'provinces/villages/' + district_id,
            type: 'GET',
            data : {
              "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (data) {
              if (data) {
                $('#villages').empty()
                $('#villages').append('<option disabled>Pilih Desa atau Kelurahan</option>')
                $.each(data, function(key, villages) {
                  $('select[name="villages"]').append('<option value="'+ villages.id +'">' + villages.name + '</option>')
                })
              } else {
                $('#villages').empty()
              }
            }
          })
        } else {
          $('#villages').empty()
        }
      })

    })
  </script>
@endpush