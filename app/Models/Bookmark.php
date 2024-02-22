<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lowongan_pekerjaan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowonganPekerjaan()
    {
        return $this->belongsTo(lowonganPekerjaan::class, 'lowongan_pekerjaan_id');
    }
}
