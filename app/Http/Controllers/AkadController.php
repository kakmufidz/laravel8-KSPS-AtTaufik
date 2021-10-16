<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\AngsuranKredit;
use App\Models\AngsuranMudorobah;
use App\Models\AngsuranQordh;
use App\Models\Kredit;
use App\Models\MasterData;
use App\Models\Mudorobah;
use App\Models\Pengurus;
use App\Models\Qordh;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Storage;

class AkadController extends Controller
{
    public function __construct()
    {
        $this->Anggota = new Anggota();
        $this->Kredit = new Kredit();
        $this->Qordh = new Qordh();
        $this->Mudorobah = new Mudorobah();
        $this->AngsuranKredit = new AngsuranKredit();
        $this->AngsuranQordh = new AngsuranQordh();
        $this->AngsuranMudorobah = new AngsuranMudorobah();
        $this->MasterData = new MasterData();
        $this->Pengurus = new Pengurus();
        $this->middleware('auth');
    }

    public function kredit()
    {
        $data = [
            'kredit'=>$this->Kredit->joinAnggota(),
            'totalkredit'=>$this->Kredit->sum('total_kredit'),
            'totalharga'=>$this->Kredit->sum('total_harga'),
            'totalangsuran'=>$this->AngsuranKredit->sum('jumlah_angsuran'),
            'totalsisakredit'=>$this->Kredit->sum('sisa_kredit')
        ];
        return view('layouts.akad.kredit',$data);
    }
    
    public function addKredit($id)
    {
        $data = [
            'detailAnggota'=>$this->Kredit->detailAnggota($id),
            'detailKredit'=>$this->Kredit->detailKredit($id),
            'mdata'=>$this->MasterData->detail()
        ];
        return view('layouts.akad.addKredit',$data);
    }

    public function pushKredit(Request $request)
    {
        $max = $request->maximal_angsuran;
        $rules=[
            'tglhutang'=>'required',
            'nama_barang' =>'required',
            'jumlah' =>'required|numeric|min:0|not_in:0',
            'harga' =>'required|numeric|min:0|not_in:0',
            'total_harga' =>'required|numeric|min:0|not_in:0',
            'maximal_angsuran' =>'required|numeric|min:0|not_in:0',
            'lama_angsuran' =>'required|numeric|min:0|max:{$max}|not_in:0',
            'jatuh_tempo' =>'required',
            'keterangan' =>'required'
        ];
        $messages = [
            'tglhutang.required'    => 'Tanggal harus diisi!!!',
            'nama_barang.required'  => 'Nama Barang harus diisi !!!',
            'jumlah.required'  => 'Jumlah harus diisi !!!',
            'jumlah.numeric'   => 'Jumlah harus diisi dengan angka!!!',
            'jumlah.min'       => 'Jumlah minimal 1 !!!',
            'jumlah.not_in'    => 'Jumlah minimal 1 !!!',
            'harga.required'        => 'Harga harus diisi !!!',
            'harga.numeric'         => 'Harga harus diisi dengan angka!!!',
            'harga.min'             => 'Harga tidak boleh minus !!!',
            'harga.not_in'          => 'Harga tidak boleh 0 !!!',
            'total_harga.required'  => 'Total Harga belum terisi, coba ulangi memasukan harga barang !!!',
            'total_harga.min'             => 'Total Harga tidak boleh minus, coba ulangi memasukan harga barang !!!',
            'total_harga.not_in'          => 'Total Harga masih 0, coba ulangi memasukan harga barang !!!',
            'maximal_angsuran.required'=> 'Maximal Angsuran diisi !!!',
            'maximal_angsuran.numeric' => 'Maximal Angsuran harus diisi dengan angka!!!',
            'maximal_angsuran.min'     => 'Maximal Angsuran tidak boleh minus !!!',
            'maximal_angsuran.not_in'  => 'Maximal Angsuran minimal 1 !!!',
            'lama_angsuran.required'=> 'Target Jumlah Angsuran diisi harus dengan angka !!!',
            'lama_angsuran.numeric' => 'Target Jumlah Angsuran harus diisi dengan angka!!!',
            'lama_angsuran.min'     => 'Target Jumlah Angsuran tidak boleh minus !!!',
            'lama_angsuran.max'     => 'Target Jumlah Angsuran tidak boleh melebihi maximal angsuran !!!',
            'lama_angsuran.not_in'  => 'Target Jumlah Angsuran minimal 1 !!!',
            'jatuh_tempo.required'  => 'Jatuh Tempo harus diisi !!!',
            'keterangan.required'   => 'Keterangan harus diisi !!!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        //Menghitung Keuntungan
            $lamaangsuran = $request->lama_angsuran;
            $maximalangsuran = $request->maximal_angsuran;
            $totalharga = $request->total_harga;
            $prosentasekeuntungan = $request->prosentase_keuntungankredit;
            $keuntungan = ($lamaangsuran/$maximalangsuran)*($prosentasekeuntungan/100);
            $totalkeuntungan = $totalharga * $keuntungan;
        $kredit = new Kredit();
        $kredit->no_anggota = $request->id_anggota;
        $kredit->tgl = Carbon::createFromFormat('d/m/Y', $request->tglhutang);
        $kredit->nama_barang = $request->nama_barang;
        $kredit->jumlah = $request->jumlah;
        $kredit->harga = $request->harga;
        $kredit->total_harga = $request->total_harga;
        $kredit->maximal_angsuran = $request->maximal_angsuran;
        $kredit->lama_angsuran = $request->lama_angsuran;
        $kredit->jatuh_tempo = Carbon::createFromFormat('d/m/Y', $request->jatuh_tempo);
        $kredit->total_kredit = $request->total_harga + $totalkeuntungan;
        $kredit->prosentase_keuntungankredit = $request->prosentase_keuntungankredit;
        $kredit->prosentase_danacadangan = $request->prosentase_danacadangan;
        $kredit->prosentase_danasosial = $request->prosentase_danasosial;
        $kredit->prosentase_shupengurus = $request->prosentase_shupengurus;
        $kredit->prosentase_shuanggota = $request->prosentase_shuanggota;
        $kredit->masuk_danacadangan = 0;
        $kredit->masuk_danasosial = 0;
        $kredit->masuk_shupengurus = 0;
        $kredit->masuk_shuanggota = 0;
        $kredit->sisa_kredit = $request->total_harga + $totalkeuntungan;
        $kredit->keterangan = $request->keterangan;
        $kredit->save();
        return redirect()->route('profile', [$request->id_anggota])->with('status','Data berhasil ditambahkan');
    }

    public function editKredit($id)
    {
        $data = [
            'kredit'=>$this->Kredit->joinAnggota()->where('id_kredit',$id)->first()
        ];
        return view('layouts.akad.editKredit',$data);
    }

    public function updateKredit(Request $request, $id)
    {
        $kredit = Kredit::find($id);
        $kredit->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglhutang),
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total_harga'=> $request->jumlah*$request->harga,
            'maximal_angsuran' => $request->maximal_angsuran,
            'lama_angsuran' => $request->lama_angsuran,
            'jatuh_tempo' => Carbon::createFromFormat('d/m/Y', $request->jatuh_tempo),
            'total_kredit' => ((($request->lama_angsuran/$request->maximal_angsuran)*30/100)*($request->jumlah*$request->harga))+(($request->jumlah*$request->harga)),
            'sisa_kredit' => $request->sisa_kredit,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('profile', [$request->id_anggota])->with('status','Data Berhasil Dirubah');
    }

    public function destroyKredit($id)
    {
        $kredit=Kredit::find($id)->where('id_kredit',$id);
        $kredit->delete();
        return redirect('/akad/kredit')->with('statusdg','Data Berhasil Dihapus');
    }

    public function suratKredit(Request $request, $id)
    {
        $kredit = Kredit::find($id);
        $file = $request->file_suratkredit;
        $filename = time() . '.' . $file->extension();
        $file->move('uploads/suratkredits',$filename);
        $kredit->update([
            'surat_kredit' => $filename
        ]);
        return redirect()->route('profile', [$kredit->no_anggota])->with('status','Data Berhasil Dirubah');
    }

    public function getKredit($surat_kredit)
    {
        $file = Kredit::where('surat_kredit', $surat_kredit)->value('surat_kredit');
        $pathToFile = public_path('uploads/suratkredits/' . $file);
        return response()->download($pathToFile);
    }

    public function printKredit($id_kredit)
    {
        $kredit = $this->Kredit->joinAnggota()->where('id_kredit',$id_kredit);
        return view('layouts.print.kredit-print',compact('kredit'));
    }

    public function qordh()
    {
        $data = [
            'qordh'=>$this->Qordh->joinAnggota(),
            'totalqordh'=>$this->Qordh->sum('jumlah'),
            'totalangsuran'=>$this->AngsuranQordh->sum('jumlah_angsuran')
        ];
        return view('layouts.akad.qordh',$data);
    }

    public function addQordh($id)
    {
        $data = [
            'detailAnggota'=>$this->Qordh->detailAnggota($id),
            'detailQordh'=>$this->Qordh->detailQordh($id)
        ];
        return view('layouts.akad.addQordh',$data);
    }

    public function pushQordh(Request $request)
    {
        $rules=[
            'tglhutang'=>'required',
            'jumlah' =>'required',
            'lama_angsuran' =>'required',
            'jatuh_tempo' =>'required',
            'keterangan' =>'required'
        ];
        $messages = [
            'tglhutang.required'    => 'Tanggal harus diisi!!!',
            'jumlah.required'       => 'Jumlah harus diisi dengan angka, atau diisi dengan angka 0 !!!',
            'lama_angsuran.required'=> 'Target Jumlah Angsuran harus dengan angka !!!',
            'jatuh_tempo.required'  => 'Jatuh Tempo harus diisi !!!',
            'keterangan.required'   => 'Keterangan harus diisi !!!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $qordh = new Qordh();
        $qordh->no_anggota = $request->id_anggota;
        $qordh->tgl = Carbon::createFromFormat('d/m/Y', $request->tglhutang);
        $qordh->jumlah = $request->jumlah;
        $qordh->lama_angsuran = $request->lama_angsuran;
        $qordh->jatuh_tempo = Carbon::createFromFormat('d/m/Y', $request->jatuh_tempo);
        $qordh->sisa_qordh = $request->jumlah;
        $qordh->keterangan = $request->keterangan;
        $qordh->save();
        return redirect()->route('profile', [$request->id_anggota])->with('status','Data berhasil ditambahkan');
    }

    public function editQordh($id)
    {
        $data = [
            'qordh'=>$this->Qordh->joinAnggota()->where('id_qordh',$id)->first()
        ];
        return view('layouts.akad.editQordh',$data);
    }

    public function updateQordh(Request $request, $id)
    {
        $qordh=Qordh::find($id);
        $qordh->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglhutang),
            'jumlah' => $request->jumlah,
            'lama_angsuran' => $request->lama_angsuran,
            'jatuh_tempo' => Carbon::createFromFormat('d/m/Y', $request->jatuh_tempo),
            'sisa_qordh' => $request->sisa_qordh,
            'keterangan' => $request->keterangan
        ]);
        return redirect('/akad/qordh')->with('status','Data Berhasil Dirubah');
    }
    
    public function destroyQordh($id)
    {
        $qordh=Qordh::find($id)->where('id_qordh',$id);
        $qordh->delete();
        return redirect('/akad/qordh')->with('statusdg','Data Berhasil Dihapus');
    }

    public function suratQordh(Request $request, $id)
    {
        $qordh = Qordh::find($id);
        $file = $request->file_suratqordh;
        $filename = time() . '.' . $file->extension();
        $file->move('uploads/suratqordhs',$filename);
        $qordh->update([
            'surat_qordh' => $filename
        ]);
        return redirect()->route('profile', [$qordh->no_anggota])->with('status','Data Berhasil Dirubah');
    }

    public function getQordh($surat_qordh)
    {
        $file = Qordh::where('surat_qordh', $surat_qordh)->value('surat_qordh');
        $pathToFile = public_path('uploads/suratqordhs/' . $file);
        return response()->download($pathToFile);
    }

    public function printQordh($id_qordh)
    {
        $qordh = $this->Qordh->joinAnggota()->where('id_qordh',$id_qordh);
        return view('layouts.print.qordh-print',compact('qordh'));
    }

    public function mudorobah()
    {
        $data = [
            'mudorobah'=>$this->Mudorobah->joinAnggota(),
            'totalMudorobah'=>$this->Mudorobah->sum('jumlah'),
            'totalangsuran'=>$this->AngsuranMudorobah->sum('jumlah_angsuran')
        ];
        return view('layouts.akad.mudorobah',$data);
    }

    public function addMudorobah($id)
    {
        $data = [
            'detailAnggota'=>$this->Mudorobah->detailAnggota($id),
            'detailMudorobah'=>$this->Mudorobah->detailMudorobah($id),
        ];
        $anggotas = DB::table('anggotas')->get();
        $penguruses = DB::table('penguruses')->get();
        return view('layouts.akad.addMudorobah',$data,compact('anggotas','penguruses'));
    }

    public function pushMudorobah(Request $request)
    {
        $rules=[
            'tglhutang'=>'required',
            'jenis_usaha' =>'required',
            'jumlah' =>'required',
            'bagi_hasil' =>'required',
            'berakhir' =>'required',
            'penanggungjawab' =>'required',
            'saksi' =>'required',
            'keterangan' =>'required'
        ];
        $messages = [
            'tglhutang.required'    => 'Tanggal harus diisi!!!',
            'jenis_usaha.required'  => 'Jenis Usaha harus diisi !!!',
            'jumlah.required'       => 'Jumlah harus diisi dengan angka, atau diisi dengan angka 0 !!!',
            'bagi_hasil.required'   => 'Bagi hasil harus diisi dengan angka!!!',
            'berakhir.required'     => 'Berakhir harus diisi !!!',
            'penanggungjawab.required'  => 'penanggungjawab harus diisi !!!',
            'saksi.required'        => 'Saksi harus diisi !!!',
            'keterangan.required'   => 'Keterangan harus diisi !!!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $mudorobah = new Mudorobah();
        $mudorobah->no_anggota = $request->id_anggota;
        $mudorobah->tgl = Carbon::createFromFormat('d/m/Y', $request->tglhutang);
        $mudorobah->jenis_usaha = $request->jenis_usaha;
        $mudorobah->jumlah = $request->jumlah;
        $mudorobah->bagi_hasil = $request->bagi_hasil;
        $mudorobah->berakhir = $request->berakhir;
        $mudorobah->penanggungjawab = $request->penanggungjawab;
        $mudorobah->saksi = $request->saksi;
        $mudorobah->sisa_hutang = $request->jumlah;
        $mudorobah->keterangan = $request->keterangan;
        $mudorobah->save();
        return redirect()->route('profile', [$request->id_anggota])->with('status','Data berhasil ditambahkan');
    }

    public function editMudorobah($id)
    {
        $data = [
            'mudorobah'=>$this->Mudorobah->joinAnggota()->where('id_mudorobah',$id)->first()
        ];
        $anggotas = DB::table('anggotas')->get();
        $penguruses = DB::table('penguruses')->get();
        return view('layouts.akad.editMudorobah',$data,compact('anggotas','penguruses'));
    }

    public function updateMudorobah(Request $request, $id)
    {
        $mudorobah=Mudorobah::find($id);
        $mudorobah->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglhutang),
            'jenis_usaha' => $request->jenis_usaha,
            'jumlah' => $request->jumlah,
            'bagi_hasil' => $request->bagi_hasil,
            'berakhir' => $request->berakhir,
            'penanggungjawab' => $request->penanggungjawab,
            'saksi' => $request->saksi,
            'keterangan' => $request->keterangan
        ]);
        return redirect('/akad/mudorobah')->with('status','Data Berhasil Dirubah');
    }

    public function destroyMudorobah($id)
    {
        $mudorobah=Mudorobah::find($id)->where('id_mudorobah',$id);
        $mudorobah->delete();
        return redirect('/akad/mudorobah')->with('statusdg','Data Berhasil Dihapus');
    }
    
    public function suratMudorobah(Request $request, $id)
    {
        $mudorobah = Mudorobah::find($id);
        $file = $request->file_suratmudorobah;
        $filename = time() . '.' . $file->extension();
        $file->move('uploads/suratmudorobahs',$filename);
        $mudorobah->update([
            'surat_mudorobah' => $filename
        ]);
        return redirect()->route('profile', [$mudorobah->no_anggota])->with('status','Data Berhasil Dirubah');
    }

    public function getMudorobah($surat_mudorobah)
    {
        $file = Mudorobah::where('surat_mudorobah', $surat_mudorobah)->value('surat_mudorobah');
        $pathToFile = public_path('uploads/suratmudorobahs/' . $file);
        return response()->download($pathToFile);
    }
    
    public function printMudorobah($id_mudorobah)
    {
        $mudorobah = $this->Mudorobah->joinAnggota()->where('id_mudorobah',$id_mudorobah);
        return view('layouts.print.mudorobah-print',compact('mudorobah'));
    }
}
