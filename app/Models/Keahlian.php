<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    use HasFactory;
    protected $table = 'keahlians';
    protected $fillable = [
        'user_id',
        'keahlian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lulusan()
    {
        return $this->belongsTo(Lulusan::class, 'user_id');
    }
}
