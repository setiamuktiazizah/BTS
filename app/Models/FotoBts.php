<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoBts extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function bts()
    {
        return $this->belongsTo(Bts::class, 'bts_id');
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
