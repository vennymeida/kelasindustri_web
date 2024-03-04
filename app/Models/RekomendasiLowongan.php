<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Keahlian;

class RekomendasiLowongan extends Model
{
    use HasFactory;
    protected $table = 'rekomendasilowongans';
    protected $fillable = [
        'lulusan_id',
        'loker_id',
        'score_similarity'
    ];
}
