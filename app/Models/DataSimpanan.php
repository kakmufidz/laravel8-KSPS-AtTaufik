<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DataSimpanan extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'data_simpanans';
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_jumlah';
    public $fillable = [
        'id_jumlah','id_anggota','id_jenis','tgl','jumlah_simpanan','keterangan'
    ];
    
    public function joinAnggota(){
        return DataSimpanan::join('anggotas', 'data_simpanans.id_anggota', '=', 'anggotas.id_anggota')
                ->latest('data_simpanans.created_at',Carbon::today())->paginate(10);
    }
    public function joinData(){
        return DataSimpanan::join('jenis_simpanans', 'data_simpanans.id_jenis', '=', 'jenis_simpanans.id_jenis')
                ->latest('data_simpanans.created_at',Carbon::today())->paginate(10);
    }
}
