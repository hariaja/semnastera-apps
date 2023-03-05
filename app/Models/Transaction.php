<?php

namespace App\Models;

use Illuminate\Mail\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Mail\Attachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model implements Attachable
{
  use HasFactory;

  protected $fillable = [
    'code', 'user_id', 'upload_date', 'proof', 'amount', 'status', 'reason'
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'upload_date' => 'date:c',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'code';
  }

  /**
   * Relationship to user model
   *
   */
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Get the attachable representation of the model.
   */
  public function toMailAttachment(): Attachment
  {
    return Attachment::fromPath('storage');
  }

  /**
   * Return image
   *
   */
  public function getProof()
  {
    return Storage::url($this->proof);
  }
}
