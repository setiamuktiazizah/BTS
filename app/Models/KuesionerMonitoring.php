<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerMonitoring extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'kuesioner_id');
    }
    
    public function monitoring()
    {
        return $this->belongsTo(Monitoring::class, 'monitoring_id');
    }
    
    public function jawaban_kuesioner()
    {
        return $this->belongsTo(JawabanKuesioner::class, 'jawaban_kuesioner_id');
    }
}
