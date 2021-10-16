<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Penarikan extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['tgl','deleted_at'];
    protected $table = 'penarikans';
    protected $primaryKey = 'id_penarikan';
    protected $fillable = [
        'tgl','jumlah','catatan'
    ];

    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }

    public function joinAnggota(){
        return Penarikan::join('anggotas', 'penarikans.no_anggota', '=', 'anggotas.id_anggota')
                ->latest('penarikans.created_at',Carbon::today())->paginate(10);
    }

    public function detailAnggota($id){
        return Anggota::where('id_anggota', $id)->first();
    }

    public function sumTabungan(){
        return DB::table('penarikans')->where('jenis_penarikan','Tabungan Umum')->sum('jumlah');
    }
    
    public function sumPendidikan(){
        return DB::table('penarikans')->where('jenis_penarikan','Tabungan Pendidikan')->sum('jumlah');
    }
    
    public function sumTHR(){
        return DB::table('penarikans')->where('jenis_penarikan','THR')->sum('jumlah');
    }
}
