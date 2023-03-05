<?php

namespace App\Http\Requests\Settings;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'first_name' => 'required|string|max:100',
      'last_name' => 'required|string|max:100',
      'first_title' => 'nullable|string|max:10',
      'last_title' => 'nullable|string|max:10',
      'email' => [
        'required', 'email:dns',
        Rule::unique('users', 'email')->ignore($this->user)
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        Rule::unique('users', 'phone')->ignore($this->user)
      ],
      'gender' => 'required',
      'institution' => 'required|string|max:70',
      'address' => 'required',
      'avatar' => 'image|mimes:jpg,png|max:3048',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'first_name.required' => ':attribute tidak boleh dikosongkan',
      'first_name.string' => ':attribute tidak valid, masukkan yang benar',
      'first_name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'last_name.required' => ':attribute tidak boleh dikosongkan',
      'last_name.string' => ':attribute tidak valid, masukkan yang benar',
      'last_name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'first_title.string' => ':attribute tidak valid, masukkan yang benar',
      'first_title.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'last_title.string' => ':attribute tidak valid, masukkan yang benar',
      'last_title.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'email.required' => ':attribute tidak boleh dikosongkan',
      'email.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'email.email' => ':attribute tidak valid, masukkan yang benar',

      'phone.required' => ':attribute tidak boleh dikosongkan',
      'phone.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'phone.numeric' => ':attribute harus berupa angka',
      'phone.min' => ':attribute terlalu pendek, minimal :max karakter',

      'gender.required' => ':attribute tidak boleh dikosongkan',
      'address.required' => ':attribute tidak boleh dikosongkan',

      'institution.required' => ':attribute tidak boleh dikosongkan',
      'institution.string' => ':attribute tidak valid, masukkan yang benar',
      'institution.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'image.image' => ':attribute tidak valid, pastikan memilih gambar',
      'image.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      'image.max' => ':attribute terlalu besar, maksimal :max kb',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'first_name' => 'Nama Depan',
      'last_name' => 'Nama Belakang',
      'first_title' => 'Gelar Depan',
      'last_title' => 'Gelar Belakang',
      'email' => 'Email',
      'phone' => 'Nomor Telepon',
      'gender' => 'Jenis Kelamin',
      'institution' => 'Institusi',
      'address' => 'Alamat Lengkap',
      'image' => 'Gambar',
    ];
  }
}
