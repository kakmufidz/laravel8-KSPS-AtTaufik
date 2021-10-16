<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AngsuranQordh extends Model
{
    use HasFactory;
    protected $dates = ['tgl'];
    protected $primaryKey = 'id_angsuran_qordh';

    protected $fillable = [
        'no_anggota','tgl','data_qordh','jumlah_angsuran','keterangan'
    ];
    
    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }   

    public function qordh(){
        return $this->belongsTo(Qordh::class);
    }

    public function detailAnggota($id){
        return DB::table('anggotas')->where('id_anggota', $id)->first();
    }
    
    public function detailQordh($id){
        return DB::table('qordhs')->where('no_anggota', $id)->first();
    }

    public function joinAnggota(){
        return AngsuranQordh:: join('qordhs','qordhs.id_qordh', '=', 'angsuran_qordhs.id_qordh')
                ->join('anggotas','anggotas.id_anggota', '=', 'angsuran_qordhs.no_anggota')
                ->latest('angsuran_qordhs.created_at',Carbon::today())->paginate(10);
    }
    
    public function joinQordh(){
        return AngsuranQordh::join('qordhs','qordhs.id_qordh', '=', 'angsuran_qordhs.id_qordh')
                ->latest('angsuran_qordhs.created_at',Carbon::today());
    }
}
