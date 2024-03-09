<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'kotas';

    protected $fillable = [
        'id',
        'kota',
    ];

    public function perusahaan()
    {
        return $this->hasOne(Perusahaan::class);
    }
}
