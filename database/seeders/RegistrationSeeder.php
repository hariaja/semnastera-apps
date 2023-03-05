<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Registration;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegistrationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Registration::create([
      'code' => Str::random(10),
      'title' => null,
      'date_start' => '2023-03-01',
      'date_end' => '2023-03-06',
      'status' => 1
    ]);
  }
}
