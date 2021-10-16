<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Anggota extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'anggotas';
    protected $dates = ['tgldaftar','tglahir','deleted_at'];
    protected $keyType = 'string';

    protected $fillable = [
        'id','tgldaftar','id_anggota','name','tmlahir','tglahir','alamat','ktp','pendidikan','pekerjaan','hp','image'
    ];

    public function detailAnggota($id){
        return DB::table('anggotas')->where('id_anggota', $id)->first();
    }
    public function detail(){
        return DB::table('anggotas')->first();
    }

    public function simpanan(){
        return $this->hasMany(Simpanan::class);
    }
    public function penarikan(){
        return $this->hasMany(Penarikan::class);
    }
    public function hutang(){
        return $this->hasOne(Hutang::class);
    }
    public function qordh(){
        return $this->hasMany(Qordh::class);
    }
    public function mudorobah(){
        return $this->hasMany(Mudorobah::class);
    }
    public function kredit(){
        return $this->hasMany(Kredit::class);
    }
    public function angsuran_qordh(){
        return $this->hasMany(AngsuranQordh::class);
    }
    public function angsuran_kredit(){
        return $this->hasMany(AngsuranKredit::class);
    }
    public function angsuran_mudorobah(){
        return $this->hasMany(AngsuranMudorobah::class);
    }
}
