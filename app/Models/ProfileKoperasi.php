<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProfileKoperasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kperasi','alamat','no_kantor'
    ];

    public function detail(){
        return DB::table('profile_koperasis')->first();
    }
}
