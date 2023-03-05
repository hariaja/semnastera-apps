<?php

namespace App\Repositories\Settings;

use App\Models\PermissionCategory;

class PermissionRepository
{
  protected $permission;

  public function __construct(PermissionCategory $permission)
  {
    $this->permission = $permission;
  }

  public function index()
  {
    return $this->permission->with('permissions')->get();
  }
}
