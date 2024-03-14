<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LowonganPekerjaan;


class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loker_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowonganPekerjaan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_pekerjaan_id');
    }
}
