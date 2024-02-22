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
        'gelar',
        'institusi',
        'jurusan',
        'prestasi',
        'tahun_mulai',
        'tahun_berakhir',
        'ipk',
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
