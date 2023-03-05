<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    # Roles
    $datas = [
      'Administrator',
      'Pemakalah',
      'Peserta',
      'Reviewer'
    ];

    foreach ($datas as $data) {
      $roles = Role::create([
        'name' => $data,
        'guard_name' => 'web'
      ]);
    }

    $pemakalah = $roles->where('name', 'Pemakalah')->first();
    $pemakalah->syncPermissions(
      Permission::where('name', 'LIKE', 'transactions.%')
        ->orWhere('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')->get()
    );

    $peserta = $roles->where('name', 'Peserta')->first();
    $peserta->syncPermissions(
      Permission::where('name', 'LIKE', 'transactions.%')
        ->orWhere('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')->get()
    );

    $userAdmin = User::create([
      'unique_id' => Str::random(10),
      'first_name' => 'Admin',
      'last_name' => 'Semnastera',
      'email' => 'admin@gmail.com',
      'phone' => '+6285659466622',
      'email_verified_at' => now(),
      'password' => bcrypt('password'),
      'gender' => 'Laki - Laki',
      'institution' => 'POLITEKNIK SUKABUMI',
      'address' => 'Kp. Kebon Randu RT 001/022 Kec. Cibadak, Kab. Sukabumi, Jawa Barat Indonesia 43351',
      'status' => 1
    ]);

    $userAdmin->assignRole($datas[0]);

    for ($i = 1; $i <= 50; $i++) :
      $persenters = User::factory()->create();
      $persenters->assignRole($datas[1]);
    endfor;

    for ($i = 1; $i <= 50; $i++) :
      $participant = User::factory()->create();
      $participant->assignRole($datas[2]);
    endfor;

    for ($i = 1; $i <= 50; $i++) :
      $reviewer = User::factory()->create();
      $reviewer->assignRole($datas[3]);
    endfor;
  }
}
