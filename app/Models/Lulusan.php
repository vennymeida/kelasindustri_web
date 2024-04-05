<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lulusan extends Model
{
    use HasFactory;
    protected $table = 'lulusans';
    protected $fillable = [
        'user_id',
        'alamat',
        'jenis_kelamin',
        'no_hp',
        'foto',
        'resume',
        'tgl_lahir',
        'ringkasan',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lamars()
    {
        return $this->hasMany(Lamar::class, 'id_lulusan');
    }
    public function isComplete()
    {
        return !empty($this->alamat) && !empty($this->no_hp) && !empty($this->foto);
    }
}
