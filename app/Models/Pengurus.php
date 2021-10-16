<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengurus extends Model
{
    use HasFactory;
    protected $dates = ['tglahir'];
    public $fillable = [
        'name','tmlahir','tglahir','alamat','hp','jabatan'
    ];
    
    public function pengurus(){
        return DB::table('penguruses')->latest('created_at',Carbon::today())->paginate(10);
    }
}
