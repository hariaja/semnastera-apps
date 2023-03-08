<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
  use HasFactory;

  protected $fillable = [
    'code',
    'batch',
    'revision_by',
    'journal_id',
    'revision_file'
  ];

  public function getRouteKeyName(): string
  {
    return 'code';
  }

  public function journal()
  {
    return $this->belongsTo(Journal::class, 'journal_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'revision_by');
  }
}
