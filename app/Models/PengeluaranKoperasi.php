<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PengeluaranKoperasi extends Model
{
    use HasFactory;
    protected $dates = ['tgl'];
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable = [
        'tgl','sumber_dana','pengeluaran','jumlah','harga','total_harga','keterangan'
    ];
    
    public function detailPengeluaran(){
        return DB::table('pengeluaran_koperasis')->first();
    }
}
