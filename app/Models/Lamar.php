<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Lamar extends Model
{
    use HasFactory;

    protected $table = 'lamars';

    protected $fillable = [
        'id_loker',
        'id_lulusan',
        'resume',
        'status',
    ];


    public function pencarikerja()
    {
        return $this->belongsTo(ProfileUser::class, 'id_lulusan');
    }

    public function loker()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'id_loker');
    }
}
