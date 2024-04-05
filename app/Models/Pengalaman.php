<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    use HasFactory;
    protected $table = 'pengalamans';
    protected $fillable = [
        'user_id',
        'nama_pengalaman',
        'nama_instansi',
        'alamat',
        'tipe',
        'tgl_mulai',
        'tgl_selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pengalaman()
    {
        return $this->hasOne(Pengalaman::class);
    }
}
