<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bts extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 
    ];

    public function jenis_bts()
    {
        return $this->belongsTo(JenisBts::class, 'jenis_bts_id');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'pemilik_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }

    public function foto_bts()
    {
        return $this->hasMany(FotoBts::class);
    }

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class);
    }
}
