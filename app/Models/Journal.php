<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
  use HasFactory;

  protected $fillable = [
    'code', 'user_id', 'title', 'category', 'abstract', 'upload_year', 'file', 'status'
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'code';
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function revisions()
  {
    return $this->hasMany(Revision::class, 'journal_id');
  }
}
