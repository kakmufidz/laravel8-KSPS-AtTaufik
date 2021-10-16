<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PemasukanKoperasi extends Model
{
    use HasFactory;
    protected $dates = ['tgl'];
    protected $primaryKey = 'id_pemasukan';
    protected $fillable = [
        'tgl','jenis_pemasukan','pemasukan','jumlah','keterangan'
    ];
    
    public function detailPemasukan(){
        return DB::table('pemasukan_koperasis')->first()->paginate(9);
    }
}
