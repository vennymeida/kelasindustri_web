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
        'kecamatan_id',
        'kelurahan_id',
        'pemilik',
        'nama',
        'alamat',
        'email',
        'website',
        'logo',
        'no_hp',
        'deskripsi',
        'surat_mou'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function lowonganPekerjaan()
    {
        return $this->hasMany(LowonganPekerjaan::class, 'id_perusahaan');
    }
}
