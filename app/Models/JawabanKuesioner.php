<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanKuesioner extends Model
{
    use HasFactory; 

    protected $guarded = ['id'];

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
        return $this->hasMany(KuesionerMonitoring::class, 'jawaban_kuesioner_id');
    }
}
