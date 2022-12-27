<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'is_online'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
