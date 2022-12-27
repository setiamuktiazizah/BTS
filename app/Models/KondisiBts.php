<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiBts extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_by',
        'edited_by'
    ];

    public function kondisi_bts()
    {
        return $this->hasMany(Monitoring::class, 'kondisi_bts_id');
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
