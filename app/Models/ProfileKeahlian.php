<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Keahlian;

class ProfileKeahlian extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'keahlian_id',
    ];

    public function keahlian()
    {
        return $this->belongsTo(Keahlian::class, 'keahlian_id');
    }
}
