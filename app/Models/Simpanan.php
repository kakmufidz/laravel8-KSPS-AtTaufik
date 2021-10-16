<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Simpanan extends Model
{
    use HasFactory;
    protected $dates = ['tgl'];
    protected $primaryKey = 'id_simpanan';
    protected $fillable = [
        'anggota_id_anggota','tgl','tabungan','s_wajib','s_thr','s_pendidikan','lain','catatan'
    ];

    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }
    
    public function joinAnggota(){
        return DB::table('simpanans')
                ->join('anggotas', 'simpanans.anggota_id_anggota', '=', 'anggotas.id_anggota')
                ->latest('simpanans.created_at',Carbon::today())->paginate(10);
    }

    public function joinData(){
        return DB::table('simpanans')
                ->join('data_simpanans', 'simpanans.id_simpanan', '=', 'data_simpanans.id_simpanan')
                ->latest('simpanans.created_at',Carbon::today())->paginate(10);
    }
    public function detailAnggota($id){
        return DB::table('anggotas')->where('id_anggota', $id)->first();
    }
    
    public function detailSimpanan($id){
        return DB::table('simpanans')->where('id_simpanan', $id)->first();
    }
}
