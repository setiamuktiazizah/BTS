<?php

namespace App\Models;

use App\Models\Bts;
use App\Models\FotoBts;
use App\Models\Pemilik;
use App\Models\Wilayah;
use App\Models\JenisBts;
use App\Models\LoginLog;
use App\Models\KondisiBts;
use App\Models\Monitoring;
use App\Models\RecentActivity;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'no_hp'
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

    public function create_bts()
    {
        return $this->hasMany(Bts::class, 'created_by');
    }

    public function edit_bts()
    {
        return $this->hasMany(Bts::class, 'edited_by');
    }

    public function user_surveyor()
    {
        return $this->hasMany(Monitoring::class, 'user_surveyor_id');
    }

    public function create_monitoring()
    {
        return $this->hasMany(Monitoring::class, 'created_by');
    }

    public function edit_monitoring()
    {
        return $this->hasMany(Monitoring::class, 'edited_by');
    }

    public function create_kondisi_bts()
    {
        return $this->hasMany(KondisiBts::class, 'created_by');
    }

    public function edit_kondisi_bts()
    {
        return $this->hasMany(KondisiBts::class, 'edited_by');
    }

    public function create_jenis_bts()
    {
        return $this->hasMany(JenisBts::class, 'created_by');
    }

    public function edit_jenis_bts()
    {
        return $this->hasMany(JenisBts::class, 'edited_by');
    }

    public function create_foto_bts()
    {
        return $this->hasMany(FotoBts::class, 'created_by');
    }

    public function edit_foto_bts()
    {
        return $this->hasMany(FotoBts::class, 'edited_by');
    }

    public function create_pemilik()
    {
        return $this->hasMany(Pemilik::class, 'created_by');
    }

    public function edit_pemilik()
    {
        return $this->hasMany(Pemilik::class, 'edited_by');
    }

    public function create_wilayah()
    {
        return $this->hasMany(Wilayah::class, 'created_by');
    }

    public function edit_wilayah()
    {
        return $this->hasMany(Wilayah::class, 'edited_by');
    }

    public function activities()
    {
        return $this->hasMany(RecentActivity::class, 'user_id');
    }

    public function login_logs()
    {
        return $this->hasMany(LoginLog::class, 'user_id');
    }

    public function create_kuesioner()
    {
        return $this->hasMany(Kuesioner::class, 'created_by');
    }

    public function edit_kuesioner()
    {
        return $this->hasMany(Kuesioner::class, 'edited_by');
    }

    public function create_jawaban_kuesioner()
    {
        return $this->hasMany(JawabanKuesioner::class, 'created_by');
    }

    public function edit_jawaban_kuesioner()
    {
        return $this->hasMany(JawabanKuesioner::class, 'edited_by');
    }
}
