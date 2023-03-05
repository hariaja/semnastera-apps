<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelPermission;

class Permission extends ModelPermission
{
  use HasFactory;

  public function permission_category()
  {
    return $this->belongsTo(PermissionCategory::class, 'permission_category_id');
  }
}
