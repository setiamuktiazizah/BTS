<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function bts()
    {
        return $this->belongsTo(Bts::class, 'bts_id');
    }

    public function kondisi_bts()
    {
        return $this->belongsTo(KondisiBts::class, 'kondisi_bts_id');
    }

    public function user_surveyor()
    {
        return $this->belongsTo(User::class, 'user_surveyor_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }

    public function kuesioner_monitoring()
    {
        return $this->hasMany(KuesionerMonitoring::class, 'monitoring_id');
    }
}

