<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'perusahaans';
    protected $fillable = [
        'user_id',
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
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
    public function lowonganPekerjaan()
    {
        return $this->hasMany(LowonganPekerjaan::class, 'id_perusahaan');
    }
}
