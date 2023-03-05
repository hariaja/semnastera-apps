<?php

namespace App\Http\Requests\Settings;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
      'name' => [
        'required',
        'string',
        Rule::unique('roles', 'name')->ignore($this->role)
      ],
      'permission' => 'required|min:1',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'name.required' => ':attribute tidak boleh dikosongkan',
      'name.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'name.string' => ':attribute tidak valid',
      'permission.required' => 'Mohon pilih salah satu :attribute di bawah',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes()
  {
    return [
      'name' => 'Nama Peran',
      'permission' => 'Hak Akses'
    ];
  }
}
