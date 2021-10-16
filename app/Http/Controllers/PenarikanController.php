<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Simpanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenarikanController extends Controller
{
     
    public function __construct()
    {
        $this->Penarikan=new Penarikan();
        $this->Simpanan=new Simpanan();
        $this->middleware('auth');
    }
    public function penarikan()
    {
        $data=[
            'penarikan'=>$this->Penarikan->joinAnggota()
        ];
            return view('layouts.penarikan.penarikan',$data);

    }

    public function tarik($id)
    {
        $data = [
            'detailAnggota'=> $this->Simpanan->detailAnggota($id)
        ];
        return view('layouts.penarikan.tarik',$data);
    }

    public function pushTarik(Request $request)
    {
        $rules=[
            'tgltarik'=>'required',
            'jumlah'=>'required|numeric|min:0|not_in:0',
            'catatan'=>'required'
        ];
        $messages = [
            'tgltarik.required' => 'Tanggal harus diisi !!!',
            'jumlah.required'   => 'Jumlah harus diisi !!!',
            'jumlah.numeric'     => 'Jumlah berupa angka !!!',
            'jumlah.min'        => 'Jumlah tidakboleh minus !!!',
            'jumlah.not_in'     => 'Jumlah tidak boleh angka 0 !!!',
            'catatan.required'  => 'Catatan harus diisi !!!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            // save data angsuran anggota
            $tarik = new Penarikan();
            $tarik->no_anggota = $request->id_anggota;
            $tarik->tgl = Carbon::createFromFormat('d/m/Y', $request->tgltarik);
            $tarik->jenis_penarikan = $request->jenis_penarikan;
            $tarik->jumlah = $request->jumlah;
            $tarik->catatan = $request->catatan;
            if ($tarik->save()) {
                return redirect()->route('profile', [$request->id_anggota])->with('status','Penarikan berhasil dilakukan');
            } else {
                return redirect()->route('profile', [$request->id_anggota])->with('statusdg','Penarikan gagal dilakukan');
            }
    }

    public function edit($id)
    {
        $data = [
            'penarikan'=>$this->Penarikan->joinAnggota()->where('id_penarikan', $id)->first()
        ];
        return view('layouts.penarikan.edit',$data);       
    }

    public function update(Request $request, $id)
    {
        
        $penarikan=Penarikan::find($id);
        $penarikan->update([
            'tgl'=> Carbon::createFromFormat('d/m/Y', $request->tgltarik),
            'jumlah'=>$request->jumlah,
            'catatan'=>$request->catatan
        ]);
        return redirect('/penarikan')->with('status','Data Berhasil Dirubah');
    }

    public function destroy($id)
    {
        $penarikan=penarikan::find($id)->where('id_penarikan',$id);
        $penarikan->delete();
        return redirect('/penarikan')->with('statusdg','Data Berhasil Dihapus');
    }
    
    public function print($id_penarikan)
    {
        $penarikan = $this->Penarikan->joinAnggota()->where('id_penarikan',$id_penarikan);
        return view('layouts.print.tarik-print',compact('penarikan'));
    }
}
