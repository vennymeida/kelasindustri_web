<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RekomendasiLulusan extends Model
{
    use HasFactory;
    protected $table = 'rekomendasis_lulusan';
    protected $fillable = [
        "document_id",
        "word",
        'tf_value',
        'tfidf_value',
        'document_type'
    ];
}
