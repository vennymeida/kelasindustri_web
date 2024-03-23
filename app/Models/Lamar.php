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
        'loker_id',
        'user_id',
        'resume',
        'status',
    ];


    public function lulusan()
    {
        return $this->belongsTo(Lulusan::class, 'user_id');
    }

    public function loker()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'loker_id');
    }
}
