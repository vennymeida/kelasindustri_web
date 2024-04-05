<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;
    protected $table = 'pendidikans';
    protected $fillable = [
        'user_id',
        'tingkatan',
        'nama_institusi',
        'jurusan',
        'tahun_mulai',
        'tahun_selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pendidikan()
    {
        return $this->hasOne(Pendidikan::class);
    }
}
