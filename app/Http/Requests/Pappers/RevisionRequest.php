<?php

namespace App\Http\Requests\Pappers;

use Illuminate\Foundation\Http\FormRequest;

class RevisionRequest extends FormRequest
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
      'batch' => 'required|unique:revisions,batch,' . $this->route('revisions.index'),
      'revision_file' => 'required|mimes:pdf|max:10000',
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
      'batch.required' => ':attribute tidak boleh dikosongkan',
      'batch.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',

      'revision_file.required' => ':attribute tidak boleh dikosongkan',
      'revision_file.mimes' => ':attribute harus berupa :values',
      'revision_file.max' => ':attribute tidak boleh lebih dari 10Mb',
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
      'batch' => 'Judul',
      'revision_file' => 'File',
    ];
  }
}
