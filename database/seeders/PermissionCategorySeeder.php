<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $datas = [
      'users.name',
      'roles.name',
      'registrations.name',
      'transactions.name',
      'journals.name',
      'revisions.name',
    ];

    foreach ($datas as $data) {
      PermissionCategory::create([
        'name' => $data
      ]);
    }
  }
}
