<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KeuntunganMudorobah extends Model
{
    use HasFactory;
    protected $dates = ['tgl'];
    protected $primaryKey = 'id_keuntungan';

    protected $fillable = [
        'id_mudorobah','no_anggota','tgl','data_mudorobah','laba_usaha','jumlah','prosentase_danacadangan','prosentase_danasosial','prosentase_shupengurus','prosentase_shuanggota','masuk_danacadangan','masuk_danasosial','masuk_shupengurus','masuk_shuanggota','keterangan'
    ];
    
    public function joinAnggota(){
        return DB::table('keuntungan_mudorobahs')
                ->join('anggotas','anggotas.id_anggota', '=', 'keuntungan_mudorobahs.no_anggota')
                ->latest('keuntungan_mudorobahs.created_at',Carbon::today())->paginate(10);
    }
}
