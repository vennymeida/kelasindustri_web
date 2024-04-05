<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;
    protected $table = 'pelatihans';
    protected $fillable = [
        'user_id',
        'nama_sertifikat',
        'deskripsi',
        'penerbit',
        'tgl_dikeluarkan',
        'sertifikat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pelatihan()
    {
        return $this->hasOne(Pelatihan::class);
    }
}
