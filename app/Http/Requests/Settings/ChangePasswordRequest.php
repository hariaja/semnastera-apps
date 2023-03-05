<?php

namespace App\Http\Requests\Settings;

use App\Rules\ChangePassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
      'current_password' => ['required', new ChangePassword],
      'new_password' => ['required'],
      'new_confirm_password' => ['same:new_password'],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages(): array
  {
    return [
      'current_password.required' => ':attribute tidak boleh dikosongkan',
      'new_password.required' => ':attribute tidak boleh dikosongkan',
      'new_confirm_password.same' => ':attribute tidak sama dengan password lama',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes(): array
  {
    return [
      'current_password' => 'Kata Sandi Saat Ini',
      'new_password' => 'Kata Sandi Baru',
      'new_confirm_password' => 'Konfirmasi Kata Sandi',
    ];
  }
}
