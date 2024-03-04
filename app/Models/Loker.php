<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;
    protected $table = 'lokers';
    protected $fillable = [
        'perusahaan_id',
        'nama_loker',
        'persyaratan',
        'deskripsi',
        'min_persyaratan',
        'gaji',
        'keahlian',
        'tipe_pekerjaan',
        'tgl_tutup',
        'lokasi',
        'kuota',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
