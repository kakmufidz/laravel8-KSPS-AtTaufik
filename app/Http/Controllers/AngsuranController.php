<?php

namespace App\Http\Controllers;

use App\Models\AngsuranKredit;
use App\Models\AngsuranMudorobah;
use App\Models\AngsuranQordh;
use App\Models\KeuntunganMudorobah;
use App\Models\Kredit;
use App\Models\MasterData;
use App\Models\Mudorobah;
use App\Models\Qordh;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AngsuranController extends Controller
{
    public function __construct()
    {
        $this->Qordh = new Qordh();
        $this->Kredit = new Kredit();
        $this->Mudorobah = new Mudorobah();
        $this->AngsuranQordh = new AngsuranQordh();
        $this->AngsuranKredit = new AngsuranKredit();
        $this->AngsuranMudorobah =new AngsuranMudorobah();
        $this->KeuntunganMudorobah = new KeuntunganMudorobah();
        $this->MasterData = new MasterData();
        $this->middleware('auth');
    }

    public function kredit()
    {
        $data=[
            'angsuran'=>$this->AngsuranKredit->joinAnggota(),
            'kredit'=>$this->Kredit->joinAnggota(),
            'totalkredit'=>$this->Kredit->sum('jumlah'),
            'totalangsurankredit'=>$this->AngsuranKredit->sum('jumlah_angsuran')
        ];
        return view('layouts.angsuran.kredit',$data);
    }
    public function addKredit($id)
    {
        $data = [
            'detailAnggota'=>$this->AngsuranKredit->detailAnggota($id),
            'detailKredit'=>$this->AngsuranKredit->detailKredit($id)
        ];
        return view('layouts.angsuran.addKredit',$data);
    }
    public function pushKredit(Request $request)
    {
        $rules=[
            'tglangsur'=>'required',
            'data_kredit'=>'required',
            'jumlah'=>'required',
            'keterangan'=>'required'
        ];
        $messages = [
            'tglangsur.required' => 'Tanggal harus diisi !!!',
            'data_kredit.required'=> 'Data qordh tidak boleh kosong !!!',
            'jumlah.required'    => 'Jumlah harus diisi dengan angka !!!',
            'keterangan.required'       => 'Keterangan harus diisi !!!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            // save data angsuran anggota
            $angsurankredit = new AngsuranKredit();
            $angsurankredit->id_kredit = $request->id_kredit;
            $angsurankredit->no_anggota = $request->id_anggota;
            $angsurankredit->tgl = Carbon::createFromFormat('d/m/Y', $request->tglangsur);
            $angsurankredit->data_kredit = $request->data_kredit;
            $angsurankredit->jumlah_angsuran = $request->jumlah;
            $angsurankredit->keterangan = $request->keterangan;
            if ($angsurankredit->save()) {
                // Update sisa_kredit
                $kredit = Kredit::where('no_anggota', $request->id_anggota)->orderBy('id_kredit','desc')->first();
                $kredit->sisa_kredit = $kredit->sisa_kredit - $request->jumlah;
                $kredit->update();
                if ($kredit->sisa_kredit == 0) {
                    //Menghitung Keuntungan
                        $lamaangsuran = $kredit->lama_angsuran;
                        $maximalangsuran = $kredit->maximal_angsuran;
                        $totalharga = $kredit->total_harga;
                        $keuntungan = ($lamaangsuran/$maximalangsuran)*$kredit->prosentase_keuntungankredit/100;
                        $totalkeuntungan = $totalharga * $keuntungan;
                    //Menghitung pembagian dana
                        $kredit->masuk_danacadangan = $totalkeuntungan * $kredit->prosentase_danacadangan/100;
                        $kredit->masuk_danasosial = $totalkeuntungan * $kredit->prosentase_danasosial/100;
                        $kredit->masuk_shupengurus = $totalkeuntungan * $kredit->prosentase_shupengurus/100;
                        $kredit->masuk_shuanggota = $totalkeuntungan * $kredit->prosentase_shuanggota/100;
                    $kredit->update();
                    return redirect()->route('profile', [$request->id_anggota])->with('status','Data berhasil ditambahkan, kredit telah lunas, dana cadangan sudah dimasukkan');
                    return redirect('/angsuran/kredit')->with('status','Data berhasil ditambahkan, kredit telah lunas, dana cadangan sudah dimasukkan');
                } else {
                    return redirect()->route('profile', [$request->id_anggota])->with('status','Data berhasil ditambahkan');
                }
            } else {
                return redirect()->route('profile', [$request->id_anggota])->with('status','Data gagal ditambahkan');
            }
    }
    public function editKredit($id)
    {
        $data=[
            'angsuran'=>$this->AngsuranKredit->joinAnggota()->where('id_angsuran_kredit',$id)->first(),
            'kredit'=>$this->AngsuranKredit->joinKredit()->where('id_angsuran_kredit',$id)->first()
        ];
        return view('layouts.angsuran.editKredit',$data);
    }
    public function updateKredit(Request $request, $id)
    {
        $angsuran = AngsuranKredit::find($id);
        $kredit = Kredit::where('id_kredit',$angsuran->id_kredit)->orderBy('id_kredit','desc')->first();
        $kredit->sisa_kredit = ($kredit->sisa_kredit + $angsuran->jumlah_angsuran);
        $kredit->update();
        $angsuran->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglangsuran),
            'jumlah_angsuran' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);
        if ($angsuran->update()) {
            $kredit->sisa_kredit = $kredit->sisa_kredit - $request->jumlah;
            $kredit->update();
            if ($kredit->sisa_kredit>0) {
                $kredit->masuk_danacadangan = 0;
                $kredit->masuk_danasosial = 0;
                $kredit->masuk_shupengurus = 0;
                $kredit->masuk_shuanggota = 0;
                $kredit->update();
            } else {
                //Menghitung Keuntungan
                $lamaangsuran = $kredit->lama_angsuran;
                $maximalangsuran = $kredit->maximal_angsuran;
                $totalharga = $kredit->total_harga;
                $keuntungan = ($lamaangsuran/$maximalangsuran)*$kredit->prosentase_keuntungankredit/100;
                $totalkeuntungan = $totalharga * $keuntungan;
                //Menghitung Masuk Dana Cadangan
                $kredit->masuk_danacadangan = $totalkeuntungan * $kredit->prosentase_danacadangan/100;
                $kredit->masuk_danasosial = $totalkeuntungan * $kredit->prosentase_danasosial/100;
                $kredit->masuk_shupengurus = $totalkeuntungan * $kredit->prosentase_shupengurus/100;
                $kredit->masuk_shuanggota = $totalkeuntungan * $kredit->prosentase_shuanggota/100;
            $kredit->update();
            }
            return redirect('/angsuran/kredit')->with('status','Data Berhasil Dirubah, data kredit berubah');
        } else {
            return redirect('/angsuran/kredit')->with('status','Data Gagal Dirubah');
        }
        
    }
    public function destroyKredit($id)
    {
        $angsuran = AngsuranKredit::find($id);
        $kredit = Kredit::where('id_kredit',$angsuran->id_kredit)->orderBy('id_kredit','desc')->first();
            // Delete data angsuran anggota
        if ($angsuran->delete()) {
            // Update data kredit anggota
            $kredit->sisa_kredit = $kredit->sisa_kredit + $angsuran->jumlah_angsuran;
            $kredit->update();
            if ($kredit->sisa_kredit>0) {
                $kredit->masuk_danacadangan = 0;
                $kredit->masuk_danasosial = 0;
                $kredit->masuk_shupengurus = 0;
                $kredit->masuk_shuanggota = 0;
                $kredit->update();
            } else{
                //Menghitung Keuntungan
                $lamaangsuran = $kredit->lama_angsuran;
                $maximalangsuran = $kredit->maximal_angsuran;
                $totalharga = $kredit->total_harga;
                $keuntungan = ($lamaangsuran/$maximalangsuran)*$kredit->prosentase_keuntungankredit/100;
                $totalkeuntungan = $totalharga * $keuntungan;
                //Menghitung Masuk Dana Cadangan
                $kredit->masuk_danacadangan = $totalkeuntungan * $kredit->prosentase_danacadangan/100;
                $kredit->masuk_danasosial = $totalkeuntungan * $kredit->prosentase_danasosial/100;
                $kredit->masuk_shupengurus = $totalkeuntungan * $kredit->prosentase_shupengurus/100;
                $kredit->masuk_shuanggota = $totalkeuntungan * $kredit->prosentase_shuanggota/100;
            $kredit->update();
            }
            return redirect('/angsuran/kredit')->with('status','Data Berhasil Dihapus');
        } else {
            return redirect('/angsuran/kredit')->with('statusdg','Data Gagal Dihapus');
        }
    }
    public function printKredit($id_angsuran_kredit)
    {
        $angsurankredit = $this->AngsuranKredit->joinAnggota()->where('id_angsuran_kredit',$id_angsuran_kredit);
        return view('layouts.print.angsurankredit-print',compact('angsurankredit'));
    }

    public function qordh()
    {
        $data=[
            'angsuran'=>$this->AngsuranQordh->joinAnggota(),
            'hutang'=>$this->Qordh->joinAnggota(),
            'totalHutang'=>$this->Qordh->sum('jumlah'),
            'totalAngsuran'=>$this->AngsuranQordh->sum('jumlah_angsuran')
        ];
        return view('layouts.angsuran.qordh',$data);
    }
    public function addQordh($id)
    {
        $data = [
            'detailAnggota'=>$this->AngsuranQordh->detailAnggota($id),
            'detailQordh'=>$this->AngsuranQordh->detailQordh($id)
        ];
        return view('layouts.angsuran.addQordh',$data);
    }
    public function pushQordh(Request $request)
    {
        $rules=[
            'tglangsur'=>'required',
            'data_qordh'=>'required',
            'jumlah'=>'required',
            'keterangan'=>'required'
        ];
        $messages = [
            'tglangsur.required' => 'Tanggal harus diisi !!!',
            'data_qordh.required'=> 'Data qordh tidak boleh kosong !!!',
            'jumlah.required'    => 'Jumlah harus diisi dengan angka !!!',
            'keterangan.required'=> ' Keterangan tidak boleh kosong !!!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        } 
            $angsuranqordh = new AngsuranQordh();
            $angsuranqordh->id_qordh = $request->id_qordh;
            $angsuranqordh->no_anggota = $request->id_anggota;
            $angsuranqordh->tgl = Carbon::createFromFormat('d/m/Y', $request->tglangsur);
            $angsuranqordh->data_qordh = $request->data_qordh;
            $angsuranqordh->jumlah_angsuran = $request->jumlah;
            $angsuranqordh->keterangan = $request->keterangan;
            if ($angsuranqordh->save()) {
                // Update data qordh 
                $qordh = Qordh::where('no_anggota', $request->id_anggota)->orderBy('id_qordh','desc')->first();
                $qordh->sisa_qordh = $qordh->sisa_qordh - $request->jumlah;
                $qordh->update();
                return redirect()->route('profile', [$request->id_anggota])->with('status','Data berhasil ditambahkan');
            } else {
                return redirect()->route('profile', [$request->id_anggota])->with('statusdg','Data gagal ditambahkan');
            }
    }
    public function editQordh($id)
    {
        $data=[
            'angsuran'=>$this->AngsuranQordh->joinAnggota()->where('id_angsuran_qordh',$id)->first(),
            'qordh'=>$this->AngsuranQordh->joinQordh()->where('id_angsuran_qordh',$id)->first()
        ];
        return view('layouts.angsuran.editQordh',$data);
    }
    public function updateQordh(Request $request, $id)
    {
        $angsuran=AngsuranQordh::find($id);
        $qordh = Qordh::where('id_qordh',$angsuran->id_qordh)->orderBy('id_qordh','desc')->first();
        $qordh->sisa_qordh = ($qordh->sisa_qordh + $angsuran->jumlah_angsuran);
        $qordh->update();
        $angsuran->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglangsuran),
            'jumlah_angsuran' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);
        if ($angsuran->update()) {
            $qordh->sisa_qordh = $qordh->sisa_qordh - $request->jumlah;
            $qordh->update();

            return redirect('/angsuran/qordh')->with('status','Data Berhasil Dirubah');
        } else {
            return redirect('/angsuran/qordh')->with('statusdg','Data Gagal Dirubah');
        }
    }
    public function destroyQordh($id)
    {
        $angsuran=AngsuranQordh::find($id);
            // Delete data angsuran anggota
        if ($angsuran->delete()) {
            // Update data qordh anggota
            $qordh = Qordh::where('id_qordh',$angsuran->id_qordh)->first();
            $qordh->sisa_qordh = $qordh->sisa_qordh + $angsuran->jumlah_angsuran;
            $qordh->update();
            return redirect('/angsuran/qordh')->with('status','Data Berhasil Dihapus');
        } else {
            return redirect('/angsuran/qordh')->with('statusdg','Data Berhasil Dihapus');
        }
    }
    public function printQordh($id_angsuran_qordh)
    {
        $angsuranqordh = $this->AngsuranQordh->joinAnggota()->where('id_angsuran_qordh',$id_angsuran_qordh);
        return view('layouts.print.angsuranqordh-print',compact('angsuranqordh'));
    }

    public function mudorobah()
    {
        $data=[
            'angsuran'=>$this->AngsuranMudorobah->joinAnggota(),
            'mudorobah'=>$this->Mudorobah->joinAnggota(),
            'totalHutang'=>$this->Mudorobah->sum('jumlah'),
            'totalAngsuran'=>$this->AngsuranMudorobah->sum('jumlah_angsuran')
        ];
        return view('layouts.angsuran.mudorobah',$data);
    }
    public function addMudorobah($id)
    {
        $data = [
            'detailAnggota'=>$this->AngsuranMudorobah->detailAnggota($id),
            'detailMudorobah'=>$this->AngsuranMudorobah->detailMudorobah($id)
        ];
        return view('layouts.angsuran.addMudorobah',$data);
    }
    public function pushMudorobah(Request $request)
    {
        $rules=[
            'tglangsur'=>'required',
            'data_mudorobah'=>'required',
            'jumlah'=>'required',
            'keterangan'=>'required'
        ];
        $messages = [
            'tglangsur.required'     => 'Tanggal harus diisi !!!',
            'data_mudorobah.required'=> 'Data qordh tidak boleh kosong !!!',
            'jumlah.required'        => 'Jumlah harus diisi dengan angka !!!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            $angsuranmudorobah = new AngsuranMudorobah();
            $angsuranmudorobah->id_mudorobah = $request->id_mudorobah;
            $angsuranmudorobah->no_anggota = $request->id_anggota;
            $angsuranmudorobah->tgl = Carbon::createFromFormat('d/m/Y', $request->tglangsur);
            $angsuranmudorobah->data_mudorobah = $request->data_mudorobah;
            $angsuranmudorobah->jumlah_angsuran = $request->jumlah;
            $angsuranmudorobah->keterangan = $request->keterangan;
            $angsuranmudorobah->save();
            if ($angsuranmudorobah->save()) {
                $mudorobah = Mudorobah::where('no_anggota', $request->id_anggota)->orderBy('id_mudorobah','desc')->first();
                $mudorobah->sisa_hutang = $mudorobah->sisa_hutang - $request->jumlah;
                $mudorobah->update();
                if ($mudorobah->update()) {
                return redirect()->route('profile', [$request->id_anggota])->with('status','Angsuran berhasil ditambahkan');
                } else {
                return redirect()->route('profile', [$request->id_anggota])->with('status','Angsuran berhasil ditambahkan, namun sisa hutang tidak berubah');
                }
            } else {
                return redirect()->route('profile', [$request->id_anggota])->with('statusdg','Data gagal ditambahkan');
            }
    }
    public function editMudorobah($id)
    {
        $data=[
            'angsuran'=>$this->AngsuranMudorobah->joinAnggota()->where('id_angsuran_mudorobah',$id)->first()
        ];
        return view('layouts.angsuran.editMudorobah',$data);
    }
    public function updateMudorobah(Request $request, $id)
    {
        $angsuran = AngsuranMudorobah::find($id);
        $mudorobah = Mudorobah::where('no_anggota', $request->id_anggota)->orderBy('id_mudorobah','desc')->first();
        $mudorobah->sisa_hutang = ($mudorobah->sisa_hutang + $angsuran->jumlah_angsuran);
        $mudorobah->update();
        $angsuran->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglangsuran),
            'jumlah_angsuran' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);
        if ($angsuran->update()) {
            $mudorobahnew = Mudorobah::where('no_anggota', $request->id_anggota)->orderBy('id_mudorobah','desc')->first();
            $mudorobahnew->sisa_hutang = $mudorobahnew->sisa_hutang - $request->jumlah;
            $mudorobahnew->update();
            return redirect('/angsuran/mudorobah')->with('status','Data Berhasil Dirubah');
        } else {
            return redirect('/angsuran/mudorobah')->with('statusdg','Data gagal Dirubah');
        }
        
    }
    public function destroyMudorobah($id)
    {
        $angsuran=AngsuranMudorobah::find($id)->where('id_angsuran_mudorobah',$id);
        $angsuran->delete();
        return redirect('/angsuran/mudorobah')->with('statusdg','Data Berhasil Dihapus');
    }
    public function printMudorobah($id_angsuran_mudorobah)
    {
        $angsuranmudorobah = $this->AngsuranMudorobah->joinAnggota()->where('id_angsuran_mudorobah',$id_angsuran_mudorobah);
        return view('layouts.print.angsuranmudorobah-print',compact('angsuranmudorobah'));
    }

    public function KeuntunganMudorobah()
    {
        $data=[
            'keuntungan'=>$this->KeuntunganMudorobah->joinAnggota()
        ];
        return view('layouts.angsuran.keuntungan',$data);
    }
    public function addKeuntunganMudorobah($id)
    {
        $data = [
            'detailAnggota'=>$this->AngsuranMudorobah->detailAnggota($id),
            'detailMudorobah'=>$this->AngsuranMudorobah->detailMudorobah($id),
            'mdata'=>$this->MasterData->detail()
        ];
        return view('layouts.angsuran.addKeuntungan',$data);
    }
    public function pushKeuntunganMudorobah(Request $request)
    {
        $rules=[
            'tglsetor'=>'required',
            'laba_usaha' =>'required|numeric|min:0|not_in:0',
            'prosentase_danacadangan'=>'required|numeric|min:0',
            'prosentase_danasosial'=>'required|numeric|min:0',
            'prosentase_shupengurus' =>'required|numeric|min:0',
            'prosentase_shuanggota' =>'required|numeric|min:0',
            'keterangan' =>'required'
        ];
        $messages = [
            'tglsetor.required'        => 'Tanggal harus diisi !!!',
            'laba_usaha.required'           => 'Laba Usaha harus diisi !!!',
            'laba_usaha.numeric'            => 'Laba Usaha harus diisi dengan angka!!!',
            'laba_usaha.min'                => 'Laba Usaha tidak boleh minus !!!',
            'laba_usaha.not_in'             => 'Laba Usaha tidak boleh minus !!!',
            'prosentase_danacadangan.required'=> 'Prosentase dana cadangan harus diisi !!!',
            'prosentase_danacadangan.numeric' => 'Prosentase dana cadangan harus diisi dengan angka!!!',
            'prosentase_danacadangan.min'     => 'Prosentase dana cadangan tidak boleh minus !!!',
            'prosentase_danasosial.required'  => 'Prosentase dana sosial harus diisi !!!',
            'prosentase_danasosial.numeric'   => 'Prosentase dana sosial harus diisi dengan angka!!!',
            'prosentase_danasosial.min'       => 'Prosentase dana sosial tidak boleh minus !!!',
            'prosentase_shupengurus.required' => 'SHU Pengurus harus diisi !!!',
            'prosentase_shupengurus.numeric'  => 'SHU Pengurus harus diisi dengan angka!!!',
            'prosentase_shupengurus.min'      => 'SHU Pengurus tidak boleh minus !!!',
            'prosentase_shuanggota.required' => 'SHU Anggota harus diisi !!!',
            'prosentase_shuanggota.numeric'  => 'SHU Anggota harus diisi dengan angka!!!',
            'prosentase_shuanggota.required' => 'SHU Anggota harus diisi !!!',
            'keterangan.required'           => 'Keterangan harus diisi !!!',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            // save data keuntungan mudorobah
            $mudorobah = Mudorobah::find($request->id_mudorobah);
            $keuntunganmudorobah = new KeuntunganMudorobah();
            $keuntunganmudorobah->id_mudorobah = $request->id_mudorobah;
            $keuntunganmudorobah->no_anggota = $request->id_anggota;
            $keuntunganmudorobah->tgl = Carbon::createFromFormat('d/m/Y', $request->tglsetor);
            $keuntunganmudorobah->data_mudorobah = $request->data_mudorobah;
            $keuntunganmudorobah->laba_usaha = $request->laba_usaha;
            $keuntunganmudorobah->jumlah = $request->laba_usaha * $mudorobah->bagi_hasil / 100;
            $keuntunganmudorobah->prosentase_danacadangan = $request->prosentase_danacadangan;
            $keuntunganmudorobah->prosentase_danasosial = $request->prosentase_danasosial;
            $keuntunganmudorobah->prosentase_shupengurus = $request->prosentase_shupengurus;
            $keuntunganmudorobah->prosentase_shuanggota = $request->prosentase_shuanggota;
            $keuntunganmudorobah->masuk_danacadangan = $keuntunganmudorobah->jumlah * $request->prosentase_danacadangan/100;
            $keuntunganmudorobah->masuk_danasosial = $keuntunganmudorobah->jumlah * $request->prosentase_danasosial/100;
            $keuntunganmudorobah->masuk_shupengurus = $keuntunganmudorobah->jumlah * $request->prosentase_shupengurus/100;
            $keuntunganmudorobah->masuk_shuanggota = $keuntunganmudorobah->jumlah * $request->prosentase_shuanggota/100;
            $keuntunganmudorobah->keterangan = $request->keterangan;
            if ($keuntunganmudorobah->save()) {
                return redirect()->route('profile', [$request->id_anggota])->with('status','Data keuntungan berhasil dimasukkanan');
            } else {
                return redirect()->route('profile', [$request->id_anggota])->with('status','Data gagal ditambahkan');
            }
    }
    public function editKeuntunganMudorobah($id)
    {
        $data=[
            'keuntungan'=>$this->KeuntunganMudorobah->joinAnggota()->where('id_keuntungan',$id)->first()
        ];
        return view('layouts.angsuran.editKeuntungan',$data);
    }
    public function updateKeuntunganMudorobah(Request $request, $id)
    {
        $keuntungan = KeuntunganMudorobah::find($id);
        $keuntungan->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglsetor),
            'jumlah' => $request->jumlah,
            'prosentase_danacadangan' => $request->prosentase_danacadangan,
            'prosentase_danasosial' => $request->prosentase_danasosial,
            'prosentase_shupengurus' => $request->prosentase_shupengurus,
            'prosentase_shuanggota' => $request->prosentase_shuanggota,
            'masuk_danacadangan' => $request->jumlah * $request->prosentase_danacadangan/100,
            'masuk_danasosial' => $request->jumlah * $request->prosentase_danasosial/100,
            'masuk_shupengurus' => $request->jumlah * $request->prosentase_shupengurus/100,
            'masuk_shuanggota' => $request->jumlah * $request->prosentase_shuanggota/100,
            'keterangan' => $request->keterangan
        ]);
        if ($keuntungan->update()) {
            return redirect('/angsuran/mudorobah/keuntungan')->with('status','Data Berhasil Dirubah');
        } else {
            return redirect('/angsuran/mudorobah/keuntungan')->with('status','Data Gagal Dirubah');
        }
    }
    public function destroyKeuntunganMudorobah($id)
    {
        $keuntungan = KeuntunganMudorobah::find($id);
            // Delete data angsuran anggota
        if ($keuntungan->delete()) {
            return redirect('/angsuran/mudorobah/keuntungan')->with('status','Data Berhasil Dihapus');
        } else {
            return redirect('/angsuran/mudorobah/keuntungan')->with('statusdg','Data Gagal Dihapus');
        }
    }
    public function printKeuntungan($id_keuntungan)
    {
        $keuntungan = $this->KeuntunganMudorobah->joinAnggota()->where('id_keuntungan',$id_keuntungan);
        return view('layouts.print.keuntungan-print',compact('keuntungan'));
    }
}
