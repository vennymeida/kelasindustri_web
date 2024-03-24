<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Keahlian;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail()); // Menggunakan notifikasi kustom Anda
    }
    public function lulusan()
    {
        return $this->hasOne(Lulusan::class);
    }

    public function perusahaan()
    {
        return $this->hasOne(Perusahaan::class);
    }

    public function pendidikan()
    {
        return $this->hasOne(Pendidikan::class);
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class, 'user_id');
    }

    public function lamars()
    {
        return $this->hasMany(Lamar::class, 'id_lulusan');
    }

    public function pengalaman()
    {
        return $this->hasOne(Pengalaman::class);
    }

    public function pelatihan()
    {
        return $this->hasOne(Pelatihan::class);
    }

    public function postingan()
    {
        return $this->hasOne(Postingan::class);
    }
    public function isComplete()
    {
        return !empty($this->name) && !empty($this->email) && !empty($this->password);
    }
}
