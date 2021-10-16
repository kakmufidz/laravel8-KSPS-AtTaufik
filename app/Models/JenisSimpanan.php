<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSimpanan extends Model
{
    use HasFactory;
    protected $table = 'jenis_simpanans';
    protected $primaryKey = 'id_jenis';
    public $fillable = [
        'id_jenis','kategori'
    ];
}
