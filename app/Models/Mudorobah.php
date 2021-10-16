<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mudorobah extends Model
{
    use HasFactory;
    protected $dates = ['tgl'];
    protected $primaryKey = 'id_mudorobah';

    protected $fillable = [
        'no_anggota','tgl','jenis_usaha','jumlah','bagi_hasil','berakhir','penanggungjawab','saksi','sisa_hutang','surat_mudorobah','keterangan'
    ];

    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }
    
    public function angsur(){
        return $this->hasOne(Angsuran::class);
    }
    
    public function detailAnggota($id){
        return DB::table('anggotas')->where('id_anggota', $id)->first();
    }
    
    public function detailMudorobah($id){
        return DB::table('mudorobahs')->where('no_anggota', $id)->orderBy('id_mudorobah', 'desc')->first();
    }

    public function joinAnggota(){
        return DB::table('mudorobahs')
                ->join('anggotas', 'mudorobahs.no_anggota', '=', 'anggotas.id_anggota')
                ->latest('mudorobahs.created_at',Carbon::today())->paginate(10);
    }
}
