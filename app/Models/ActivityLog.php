<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
  use HasFactory;
  use LogsActivity;

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults();
  }

  protected $table = 'activity_log';

  public function user()
  {
    return $this->belongsTo(User::class, 'causer_id');
  }
}
