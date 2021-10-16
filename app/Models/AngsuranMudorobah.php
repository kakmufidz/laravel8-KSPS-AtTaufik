<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AngsuranMudorobah extends Model
{
    use HasFactory;
    protected $dates = ['tgl'];
    protected $primaryKey = 'id_angsuran_mudorobah';

    protected $fillable = [
        'no_anggota','tgl','data_akad','jumlah_angsuran','keterangan'
    ];
    
    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }   

    public function mudorobah(){
        return $this->belongsTo(Mudorobah::class);
    }

    public function detailAnggota($id){
        return DB::table('anggotas')->where('id_anggota', $id)->first();
    }
    
    public function detailMudorobah($id){
        return DB::table('mudorobahs')->where('no_anggota', $id)->first();
    }

    public function joinAnggota(){
        return AngsuranMudorobah::join('mudorobahs','mudorobahs.id_mudorobah', '=', 'angsuran_mudorobahs.id_mudorobah')
                ->join('anggotas','anggotas.id_anggota', '=', 'angsuran_mudorobahs.no_anggota')
                ->latest('angsuran_mudorobahs.created_at',Carbon::today())->paginate(10);
    }
}
