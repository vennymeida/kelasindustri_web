<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'perusahaan';
    protected $fillable = [
        'user_id',
        'kota_id',
        'nama_pemilik',
        'surat_mou',
        'nama_perusahaan',
        'logo_perusahaan',
        'email_perusahaan',
        'alamat_perusahaan',
        'deskripsi',
        'no_hp',
        'website',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lulusan()
    {
        return $this->belongsTo(Lulusan::class, 'user_id');
    }
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
    public function lowonganPekerjaan()
    {
        return $this->hasMany(LowonganPekerjaan::class, 'perusahaan_id');
    }
}
