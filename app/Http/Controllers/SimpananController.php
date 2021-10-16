<?php

namespace App\Http\Controllers;

use App\Models\DataSimpanan;
use App\Models\JenisSimpanan;
use App\Models\Kredit;
use App\Models\Penarikan;
use App\Models\Simpanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SimpananController extends Controller
{
      
    public function __construct()
    {
        $this->Simpanan = new Simpanan();
        $this->Penarikan=new Penarikan();
        $this->Kredit = new Kredit();
        $this->JenisSimpanan = new JenisSimpanan();
        $this->DataSimpanan = new DataSimpanan();
        $this->middleware('auth');
    }
    public function simpan()
    {
        $data=[
            'simpanan'=>$this->Simpanan->joinAnggota()
        ];
            return view('layouts.simpanan.simpanan',$data);
    }
    public function tambah($id_anggota)
    {
        $mdata = DB::table('master_datas')->first();
        $data_simpanan = DB::table('data_simpanans')->orderBy('id_jumlah','desc')->first();
        $jenis_simpanan = DB::table('jenis_simpanans')->get();
        $id_anggota = $id_anggota;
        $data = [
            'joinData'=> $this->DataSimpanan->joinAnggota()->where('id_anggota',$id_anggota)->first(),
            's_wajib'=> DataSimpanan::where('id_anggota', $id_anggota)->where('kategori','Simpanan Wajib')->value('jumlah_simpanan'),
            'detailKredit'=> $this->Kredit->detailKredit($id_anggota)
        ];
        return view('layouts.simpanan.simpanan-cart',$data,compact('mdata','jenis_simpanan','id_anggota','data_simpanan'));
    }
    public function pushTambah(Request $request)
    {
        $rules=[
            'id_anggota'=>'required',
            'tglsetor'=>'required',
            'catatan'=>'nullable'
        ];
        $messages = [
            'tglsetor.required'     => 'Tanggal harus diisi!!!',
            's_pendidikan.numeric' => 'Simpanan Pendidikan harus diisi dengan angka, atau diisi dengan angka 0 !!!'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            $kategori = DB::table('jenis_simpanans')->get('kode_jenis')->toArray();
            foreach ($kategori as $key) {
                $str_json = json_encode($key);
                $fixkode = substr($str_json,15,-2);
                $notreplace = preg_split('/(?=[A-Z])/', $fixkode, -1, PREG_SPLIT_NO_EMPTY);
                $notreplaces = join(" ",$notreplace);
                $jumlah_simpanan = request($fixkode);
                if ($jumlah_simpanan == null) {
                } elseif ($jumlah_simpanan == 0) {
                } else {
                    $ide=$request->id_anggota;
                    $data_simpanan = new DataSimpanan();
                    $idjenis = DB::table('jenis_simpanans')->where('kategori',$notreplaces)->value('id_jenis');
                    $data = [
                        ['id_simpanan'=>$request->id_simpanan, 'id_anggota'=>$ide, 'id_jenis'=>$idjenis, 'kategori'=>$notreplaces, 'tgl'=>Carbon::createFromFormat('d/m/Y', $request->tglsetor), 'jumlah_simpanan'=>$jumlah_simpanan, 'keterangan'=>$request->keterangan, 'created_at'=>Carbon::now()]
                    ];
                    $data_simpanan->insert($data);
                }
            }
            return redirect()->route('profile', [$request->id_anggota])->with('status','Setoran berhasil dilakukan');
            
    }
    public function print($id_simpanan)
    {
        $joinAnggota = $this->DataSimpanan->joinAnggota()->where('id_simpanan',$id_simpanan)->first();
        $datasimpanan = $this->DataSimpanan->where('id_simpanan',$id_simpanan)->get();
        return view('layouts.print.setoran-print',compact('datasimpanan','joinAnggota'));
    }
}
