<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StopWord extends Model
{
    use HasFactory;

    protected $table = 'stop_word';

    protected $fillable = [
        'text'
    ];
}
