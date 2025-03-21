<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReverseShareInvite extends Model
{
  protected $fillable = [
    'user_id',
    'guest_user_id',
    'recipient_name',
    'recipient_email',
    'message',
    'expires_at'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function guestUser()
  {
    return $this->belongsTo(User::class, 'guest_user_id');
  }

  public function isExpired()
  {
    return $this->expires_at && now()->gt($this->expires_at);
  }

  public function markAsUsed()
  {
    $this->used_at = now();
    $this->save();
  }

  public function isUsed()
  {
    return $this->used_at !== null;
  }

  
}
