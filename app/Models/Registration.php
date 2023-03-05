<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
  use HasFactory;

  protected $fillable = [
    'code', 'title', 'date_start', 'date_end', 'status'
  ];

  protected $casts = [
    'date_start' => 'date:c',
    'date_end' => 'date:c'
  ];

  public function getRouteKeyName(): string
  {
    return 'code';
  }
}
