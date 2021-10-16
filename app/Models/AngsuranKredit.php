<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AngsuranKredit extends Model
{
    use HasFactory;
    protected $dates = ['tgl'];
    protected $primaryKey = 'id_angsuran_kredit';

    protected $fillable = [
        'no_anggota','tgl','data_akad','jumlah_angsuran','keterangan'
    ];
    
    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }   

    public function kredit(){
        return $this->belongsTo(Kredit::class);
    }

    public function detailAnggota($id){
        return DB::table('anggotas')->where('id_anggota', $id)->orderBy('id_anggota','desc')->first();
    }
    
    public function detailKredit($id){
        return DB::table('kredits')->where('no_anggota', $id)->orderBy('id_kredit','desc')->first();
    }

    public function joinAnggota(){
        return AngsuranKredit::join('anggotas','anggotas.id_anggota', '=', 'angsuran_kredits.no_anggota')
                ->join('kredits','kredits.id_kredit', '=', 'angsuran_kredits.id_kredit')
                ->latest('angsuran_kredits.created_at',Carbon::today())->paginate(10);
    }
    
    public function joinKredit(){
        return AngsuranKredit::join('kredits','kredits.id_kredit', '=', 'angsuran_kredits.id_kredit')
                ->latest('angsuran_kredits.created_at',Carbon::today());
    }
}
