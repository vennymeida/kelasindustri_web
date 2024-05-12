<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'link_portofolio',
        'nama_portofolio',
        'dokumen_portofolio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
