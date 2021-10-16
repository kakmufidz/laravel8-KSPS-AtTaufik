<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kredit extends Model
{
    use HasFactory;
    protected $dates = ['tgl','jatuh_tempo'];
    protected $primaryKey = 'id_kredit';

    protected $fillable = [
        'no_anggota','tgl','nama_barang','jumlah','harga','total_harga','lama_angsuran','jatuh_tempo','total_kredit','surat_kredit','prosentase_keuntungankredit','prosentase_danacadangan','prosentase_danasosial','prosentase_shupengurus','prosentase_shuanggota','masuk_danacadangan','masuk_danasosial','masuk_shupengurus','masuk_shuanggota','sisa_kredit','keterangan'
    ];

    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }
    
    public function angsuran_kredit(){
        return $this->hasMany(Kredit::class);
    }
    
    public function detailAnggota($id){
        return DB::table('anggotas')->where('id_anggota', $id)->first();
    }

    public function detailKredit($id){
        return DB::table('kredits')->where('no_anggota', $id)->orderBy('id_kredit', 'desc')->first();
    }
    
    public function joinAnggota(){
        return DB::table('kredits')
                ->join('anggotas', 'kredits.no_anggota', '=', 'anggotas.id_anggota')
                ->latest('kredits.created_at',Carbon::today())->paginate(10);
    }
}
