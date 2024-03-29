<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookmark;
use App\Models\Lamar;

class LowonganPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'lokers';
    protected $fillable = [
        'perusahaan_id',
        'nama_loker',
        'persyaratan',
        'deskripsi',
        'tipe_pekerjaan',
        'keahlian',
        'lokasi',
        'gaji_bawah',
        'gaji_atas',
        'kuota',
        'tgl_tutup',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'loker_id');
    }
    public function lamars()
    {
        return $this->hasMany(Lamar::class, 'loker_id');
    }

    public function getHasAppliedAttribute()
    {
        if (auth()->check() && auth()->user()->lulusan) {
            return Lamar::where('loker_id', $this->id)
                ->where('user_id', auth()->user()->id)
                ->exists();
        }

        return false;
    }
}
