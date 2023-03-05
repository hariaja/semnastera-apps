<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\ValidationRule;

class ChangePassword implements ValidationRule
{
  /**
   * Run the validation rule.
   *
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    if (Hash::check($value, auth()->user()->password)) {
      $fail('Password anda salah. Masukkan password yang sesuai.');
    }
  }
}
