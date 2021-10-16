<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterData extends Model
{
    use HasFactory;
    protected $table = 'master_datas';
    public $fillable =[
        'id','registrasi','s_pokok','s_wajib','qordh','prosentase_keuntungan','prosentase_danacadangan','prosentase_danasosial','prosentase_shupengurus','prosentase_shuanggota'
    ];
    public function detail()
    {
        return DB::table('master_datas')->orderBy('id', 'desc')->first();
    }
}
