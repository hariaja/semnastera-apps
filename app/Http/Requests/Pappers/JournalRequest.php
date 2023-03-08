<?php

namespace App\Http\Requests\Pappers;

use Illuminate\Foundation\Http\FormRequest;

class JournalRequest extends FormRequest
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
      'title' => 'required|unique:journals,title,' . $this->route('journals.index'),
      'category' => 'required',
      'abstract' => 'required',
      'file' => 'required|mimes:pdf|max:10000',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'title.required' => ':attribute tidak boleh dikosongkan',
      'title.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',

      'category.required' => ':attribute tidak boleh dikosongkan',
      'abstract.required' => ':attribute tidak boleh dikosongkan',

      'file.required' => ':attribute tidak boleh dikosongkan',
      'file.mimes' => ':attribute harus berupa :values',
      'file.max' => ':attribute tidak boleh lebih dari 10Mb',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function attributes(): array
  {
    return [
      'title' => 'Judul',
      'category' => 'Kategori',
      'abstract' => 'Abstrak',
      'file' => 'File',
    ];
  }
}
