<?php

namespace App\Models;

use App\Helpers\StatusConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role as ModelRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends ModelRole
{
  use HasFactory;
}
