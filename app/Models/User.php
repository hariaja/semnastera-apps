<?php

namespace App\Models;

use App\Helpers\StatusConstant;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'unique_id',
    'first_name',
    'last_name',
    'first_title',
    'last_title',
    'email',
    'phone',
    'password',
    'avatar',
    'gender',
    'institution',
    'status',
    'address'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  protected static $logAttributes = [
    'first_name',
    'last_name',
    'first_title',
    'last_title',
    'email',
    'phone',
    'password',
    'avatar',
    'gender',
    'institution',
    'status',
    'address'
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'unique_id';
  }

  /**
   * Return Default Avatar
   *
   */
  public function getDefaultAvatar()
  {
    if (!$this->avatar) {
      return asset('assets/images/user_default.png');
    } else {
      return Storage::url($this->avatar);
    }
  }

  public function scopeActive($data)
  {
    return $data->where('status', StatusConstant::ACTIVE);
  }

  public function getActive(): Collection
  {
    return $this->active()->get();
  }

  public function isRoleId()
  {
    return $this->roles->implode('id');
  }

  public function isRole()
  {
    return $this->roles->implode('name');
  }

  /**
   * Check user status
   *
   */
  public function getUserStatus()
  {
    if ($this->status == StatusConstant::ACTIVE) :
      return '<span class="badge bg-success">Active</span>';
    else :
      return '<span class="badge bg-danger">Inactive</span>';
    endif;
  }

  /**
   * Relationship to transactions model
   *
   */
  public function transactions()
  {
    return $this->hasMany(Transaction::class, 'user_id');
  }

  /**
   * Relationship to journals model
   *
   */
  public function journals()
  {
    return $this->hasMany(Journal::class, 'user_id');
  }

  public function getUserFullNameLong()
  {
    if ($this->getUserFirstTitle() && $this->getUserLastTitle()) :
      return $this->getUserFirstTitle() . $this->getUserFullNameShort() . $this->getUserLastTitle();
    endif;

    if ($this->getUserFirstTitle()) :
      return $this->getUserFirstTitle() . $this->getUserFullNameShort();
    endif;

    if ($this->getUserLastTitle()) :
      return $this->getUserFullNameShort() . $this->getUserLastTitle();
    endif;

    return $this->getUserFullNameShort();
  }

  public function getUserFullNameShort()
  {
    return $this->getUserFirstName() . ' ' . $this->getUserLastName();
  }

  public function getUserFirstName()
  {
    return $this->first_name;
  }

  public function getUserLastName()
  {
    return $this->last_name;
  }

  public function getUserFirstTitle()
  {
    return $this->first_title ? $this->first_title : '';
  }

  public function getUserLastTitle()
  {
    return $this->last_title ? ', ' . $this->last_title : '';
  }
}
