<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBts extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_by',
        'edited_by'
    ];

    public function bts()
    {
        return $this->hasMany(Bts::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
