<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
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
        'document',
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

    public function getDocumentUrl()
    {
        if ($this->document) {
            return Storage::url($this->document);  // Mendapatkan URL untuk dokumen yang diunggah
        }
        return null;
    }

    public function deleteDocument()
    {
        if ($this->document) {
            Storage::disk('public')->delete($this->document);  // Hapus dokumen
        }
    }

    public function lulusan()
    {
        return $this->hasOne(Lulusan::class);
    }

    public function perusahaan()
    {
        return $this->hasOne(Perusahaan::class);
    }

    public function superadmin()
    {
        return $this->hasOne(Superadmin::class);
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
        return $this->hasMany(Lamar::class, 'user_id');
    }

    public function pengalaman()
    {
        return $this->hasOne(Pengalaman::class);
    }

    public function pelatihan()
    {
        return $this->hasOne(Pelatihan::class);
    }
    public function keahlians()
    {
        return $this->hasMany(Keahlian::class);
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
