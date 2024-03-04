<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RekomendasiLoker extends Model
{
    use HasFactory;
    protected $table = 'rekomendasis_loker';
    protected $fillable = [
        "document_id",
        "word",
        'df_value',
        'tfidf_value',
        'document_type'
    ];
}
