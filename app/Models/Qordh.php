<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Qordh extends Model
{
    use HasFactory;
    protected $dates = ['tgl','jatuh_tempo'];
    protected $primaryKey = 'id_qordh';

    protected $fillable = [
        'no_anggota','tgl','jumlah','lama_angsuran','jatuh_tempo','sistem_angsur','sisa_qordh','surat_qordh','keterangan'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function angsuran_qordh(){
        return $this->hasOne(AngsuranQordh::class);
    }
    
    public function detailAnggota($id){
        return DB::table('anggotas')->where('id_anggota', $id)->first();
    }
    
    public function detailQordh($id){
        return DB::table('qordhs')->where('no_anggota', $id)->orderBy('id_qordh', 'desc')->first();
    }
    
    public function joinAnggota(){
        return DB::table('qordhs')
                ->join('anggotas', 'qordhs.no_anggota', '=', 'anggotas.id_anggota')
                ->latest('qordhs.created_at',Carbon::today())->paginate(10);
    }
}
