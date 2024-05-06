<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProfileKeahlian;

class Keahlian extends Model
{
    use HasFactory;
    protected $table = 'keahlians';
    protected $fillable = [
        'keahlian'
    ];

    public function profileKeahlians()
    {
        return $this->hasMany(ProfileKeahlian::class);
    }
}
