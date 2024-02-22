<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookmark;
use App\Models\lamar;

class LowonganPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'lokers';
    protected $fillable = [
        'user_id',
        'id_perusahaan',
        'judul',
        'deskripsi',
        'requirement',
        'tipe_pekerjaan',
        'min_pendidikan',
        'min_pengalaman',
        'lokasi',
        'gaji_bawah',
        'gaji_atas',
        'jumlah_pelamar',
        'tutup',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(ProfileUser::class, 'user_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }

    public function kategori()
    {
        return $this->belongsToMany(KategoriPekerjaan::class, 'lowongan_kategori', 'lowongan_id', 'kategori_id');
    }

    public function keahlian()
    {
        return $this->belongsToMany(Keahlian::class, 'lowongan_keahlian', 'lowongan_id', 'keahlian_id');
    }
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'lowongan_pekerjaan_id');
    }
    public function lamars()
    {
        return $this->hasMany(Lamar::class, 'id_loker');
    }

    public function getHasAppliedAttribute()
    {
        if (auth()->check() && auth()->user()->profile) {
            return Lamar::where('id_loker', $this->id)
                ->where('id_lulusan', auth()->user()->profile->id)
                ->exists();
        }

        return false;
    }
}
