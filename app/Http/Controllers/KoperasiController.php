<?php

namespace App\Http\Controllers;

use App\Models\AngsuranKredit;
use App\Models\AngsuranMudorobah;
use App\Models\AngsuranQordh;
use App\Models\DataSimpanan;
use App\Models\JenisSimpanan;
use App\Models\KeuntunganMudorobah;
use App\Models\Kredit;
use App\Models\MasterData;
use App\Models\Mudorobah;
use App\Models\PemasukanKoperasi;
use App\Models\Penarikan;
use App\Models\PengeluaranKoperasi;
use App\Models\Pengurus;
use App\Models\ProfileKoperasi;
use App\Models\Qordh;
use App\Models\Simpanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class KoperasiController extends Controller
{
    //
    public function __construct()
    {
        $this->ProfileKoperasi = new ProfileKoperasi();
        $this->PemasukanKoperasi = new PemasukanKoperasi();
        $this->PengeluaranKoperasi = new PengeluaranKoperasi();
        $this->KeuntunganMudorobah = new KeuntunganMudorobah();
        $this->AngsuranKredit = new AngsuranKredit();
        $this->MasterData = new MasterData();
        $this->Pengurus = new Pengurus();
        $this->User = new User();
        $this->JenisSimpanan = new JenisSimpanan();
        $this->middleware('auth');
    }

    public function pushKoperasi(Request $request)
    {
        $rules=[
            'nama_koperasi'=>'required',
            'alamat' =>'required',
            'no_kantor' =>'required'
        ];
        $messages = [
            'nama_koperasi.required'    => 'Nama koperasi harus diisi!!!',
            'alamat.required'  => 'Alamat koperasi harus diisi !!!',
            'no_kantor.required'       => 'Nomor kantor/ketua koperasi harus diisi !!!',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $koperasi = new ProfileKoperasi();
        $koperasi->nama_koperasi = $request->nama_koperasi;
        $koperasi->alamat = $request->alamat;
        $koperasi->no_kantor = $request->no_kantor;
        if ($koperasi->save()) {
            return redirect('/koperasi');
        } else {
            return redirect()->back()->with('statusdg','Data gagal ditambahkan');
        }
    }
    public function editKoperasi($id)
    {
        $data = [
            'koperasi'=> $this->ProfileKoperasi->where('id',$id)->first()
        ];
        return view('layouts.koperasi.editKoperasi',$data);
    }
    public function updateKoperasi(Request $request, $id)
    {
        $koperasi = ProfileKoperasi::find($id);
        $koperasi->update([
            'nama_koperasi' => $request->nama_koperasi,
            'alamat' => $request->alamat,
            'no_kantor' => $request->no_kantor
        ]);
        if ($koperasi->update()) {
            return redirect('/koperasi');
        } else {
            return redirect()->back()->with('statusdg','Data gagal diedit');
        }
        
    }

    public function index()
    {
        $data = [
            'koperasi'=> $this->ProfileKoperasi->detail()
        ];
        $pemasukan = PemasukanKoperasi::latest()->paginate(10);
        $pengeluaran = PengeluaranKoperasi::latest()->paginate(10);
        //SHU
            $shupenguruskredit = Kredit::sum('masuk_shupengurus');
            $shuanggotakredit = Kredit::sum('masuk_shuanggota');
            $shupengurusmudorobah = KeuntunganMudorobah::sum('masuk_shupengurus');
            $shuanggotamudorobah = KeuntunganMudorobah::sum('masuk_shuanggota');
            $pengeluaranshupengurus = PengeluaranKoperasi::where('sumber_dana','SHU Pengurus')->sum('total_harga');
            $pengeluaranshuanggota = PengeluaranKoperasi::where('sumber_dana','SHU Anggota')->sum('total_harga');
            $totalshupengurus = ($shupenguruskredit + $shupengurusmudorobah) - $pengeluaranshupengurus;
            $totalshuanggota = ($shuanggotakredit + $shuanggotamudorobah) - $pengeluaranshuanggota;
            $totalshu = $totalshupengurus + $totalshuanggota;
        // Dana Sosial
            $danasosialkredit = Kredit::sum('masuk_danasosial');
            $danasosialmudorobah = KeuntunganMudorobah::sum('masuk_danasosial');
            $totalpemasukasosial = PemasukanKoperasi::where('jenis_pemasukan','Dana Sosial')->sum('jumlah');
            $totalpengeluaransosial = PengeluaranKoperasi::where('sumber_dana','Dana Sosial')->sum('total_harga');
            $totaldanasosial = ($danasosialkredit + $danasosialmudorobah + $totalpemasukasosial) - $totalpengeluaransosial;
        // Dana Aman
            $totaltabungan = Simpanan::sum('tabungan');
            $totals_wajib = Simpanan::sum('s_wajib');
            $totals_thr = Simpanan::sum('s_thr');
            $totals_pendidikan = Simpanan::sum('s_pendidikan');
            $totals_pokok = Simpanan::sum('s_pokok');
            $totalpemasukanaman = PemasukanKoperasi::where('jenis_pemasukan','Dana Aman')->sum('jumlah');
            $totalpenarikantabungan = Penarikan::where('jenis_penarikan','Tabungan Umum')->sum('jumlah');
            $totalpenarikanpendidikan = Penarikan::where('jenis_penarikan','Tabungan Pendidikan')->sum('jumlah');
            $totalpenarikanthr = Penarikan::where('jenis_penarikan','THR')->sum('jumlah');
            $totalpengeluarandanaaman = PengeluaranKoperasi::where('sumber_dana','Dana Aman')->sum('total_harga');
            $totalkredit = Kredit::sum('total_harga');
            $totalqordh = Qordh::sum('jumlah');
            $totalmudorobah = Mudorobah::sum('jumlah');
            $totalangsurankredit = AngsuranKredit::sum('jumlah_angsuran');
            $totalangsuranqordh = AngsuranQordh::sum('jumlah_angsuran');
            $totalangsuranmudorobah = AngsuranMudorobah::sum('jumlah_angsuran');
            // pengembalian piutang kredit
            $sisakredit = $totalkredit-$totalangsurankredit;
            if ($sisakredit>=0) {
                $piutangkredit = $totalangsurankredit;
            } elseif ($sisakredit<0) {
                $piutangkredit = ($totalkredit);
            }
            // pengembalian piutang qordh
            $hargaqordh = $totalqordh-$totalangsuranqordh;
            if ($hargaqordh<=0) {
                $piutangqordh = ($totalangsuranqordh + $hargaqordh);
            } else {
                $piutangqordh = $totalangsuranqordh;
            }
            // pengembalian piutang mudorobah
            $hargamudorobah = $totalmudorobah-$totalangsuranmudorobah;
            if ($hargamudorobah<=0) {
                $piutangmudorobah = ($totalangsuranmudorobah + $hargamudorobah);
            } else {
                $piutangmudorobah = $totalangsuranmudorobah;
            }
            $danaaman = ($totaltabungan + $totals_wajib + $totals_thr +$totals_pendidikan + $totals_pokok + $totalpemasukanaman + $piutangkredit + $piutangqordh + $piutangmudorobah) 
                      - ($totalpenarikantabungan + $totalpenarikanpendidikan + $totalpenarikanthr + $totalkredit + $totalqordh + $totalmudorobah + $totalpengeluarandanaaman);
        //Dana Cadangan
            $keuntungankredit = Kredit::sum('masuk_danacadangan');
            $keuntunganmudorobah = KeuntunganMudorobah::sum('masuk_danacadangan');
            $totalpemasukancadangan = PemasukanKoperasi::where('jenis_pemasukan','Dana Cadangan')->sum('jumlah');
            $totalregistrasi = Simpanan::sum('registrasi');
            $totalpengeluarandanacadangan = PengeluaranKoperasi::where('sumber_dana','Dana Cadangan')->sum('total_harga');
            $danacadangan = ($keuntungankredit + $keuntunganmudorobah + $totalpemasukancadangan + $totalregistrasi) - $totalpengeluarandanacadangan;
        //Saldo Koperasi
            $kasokoperasi = $danaaman + $danacadangan + $totaldanasosial + $totalshupengurus + $totalshuanggota;
        return view('layouts.koperasi.koperasi',$data,compact('data','pemasukan','pengeluaran','danaaman',
        'danacadangan','kasokoperasi','totalshupengurus','totalshuanggota','totaldanasosial'));
    }

    public function addPemasukan()
    {
        return view('layouts.koperasi.addPemasukan');
    }
    
    public function pushPemasukan(Request $request)
    {
        $rules=[
            'tglmasuk'=>'required',
            'jenis_pemasukan'=>'required',
            'pemasukan' =>'required',
            'jumlah' =>'required|numeric|min:0|not_in:0',
            'keterangan' =>'required'
        ];
        $messages = [
            'tglmasuk.required'    => 'Tanggal harus diisi!!!',
            'jenis_pemasukan.required'    => 'Pilih salah satu jenis pemasukan!!!',
            'pemasukan.required'  => 'Pemasukan harus diisi !!!',
            'jumlah.required'       => 'Jumlah harus diisi !!!',
            'jumlah.numeric'         => 'Jumlah harus diisi dengan angka!!!',
            'jumlah.min'             => 'Jumlah tidak boleh minus !!!',
            'jumlah.not_in'          => 'Jumlah tidak boleh 0 !!!',
            'keterangan.required'   => 'Keterangan harus diisi !!!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $masuk = new PemasukanKoperasi();
        $masuk->tgl = Carbon::createFromFormat('d/m/Y', $request->tglmasuk);
        $masuk->jenis_pemasukan = $request->jenis_pemasukan;
        $masuk->pemasukan = $request->pemasukan;
        $masuk->jumlah = $request->jumlah;
        $masuk->keterangan = $request->keterangan;
        if ($masuk->save()) {
            return redirect('/koperasi')->with('status','Pemasukan berhasil dilakukan');
        } else {
            return redirect()->back()->with('statusdg','Pemasukan gagal dilakukan');
        }
        
    }

    public function editPemasukan($id_pemasukan)
    {
        $data = [
            'pemasukan'=> $this->PemasukanKoperasi->where('id_pemasukan',$id_pemasukan)->first()
        ];
        return view('layouts.koperasi.editPemasukan',$data);
    }

    public function updatePemasukan(Request $request, $id_pemasukan)
    {
        $pemasukan = PemasukanKoperasi::find($id_pemasukan);
        $pemasukan->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglmasuk),
            'jenis_pemasukan' => $request->jenis_pemasukan,
            'pemasukan' => $request->pemasukan,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);
        if ($pemasukan->update()) {
            return redirect('/koperasi')->with('status','Data berhasil diedit');
        } else {
            return redirect('/koperasi')->with('statusdg','Data gagal diedit');
        }
        
    }

    public function destroyPemasukan($id_pemasukan){
        $pemasukan = PemasukanKoperasi::find($id_pemasukan);
        if ($pemasukan->delete()) {
            return redirect('/koperasi')->with('status','Data berhasil dihapus');
        } else {
            return redirect('/koperasi')->with('statusdg','Data gagal diedit');
        }
    }
    
    public function addPengeluaran(){
        return view('layouts.koperasi.addPengeluaran');
    }
    
    public function pushPengeluaran(Request $request){
        $rules=[
            'tglkeluar'=>'required',
            'pengeluaran' =>'required',
            'jumlah' =>'required',
            'harga' =>'required',
            'total_harga' =>'required',
            'keterangan' =>'required'
        ];
        $messages = [
            'tglkeluar.required'    => 'Tanggal harus diisi!!!',
            'pengeluaran.required'  => 'Pengeluaran harus diisi !!!',
            'jumlah.required'       => 'Jumlah harus diisi dengan angka !!!',
            'harga.required'        => 'Harga harus diisi dengan angka !!!',
            'total_harga.required'  => 'Total harga harusnya terisi dengan angka !!!',
            'keterangan.required'   => 'Keterangan harus diisi !!!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $keluar = new PengeluaranKoperasi();
        $keluar->tgl = Carbon::createFromFormat('d/m/Y', $request->tglkeluar);
        $keluar->sumber_dana = $request->sumber_dana;
        $keluar->pengeluaran = $request->pengeluaran;
        $keluar->jumlah = $request->jumlah;
        $keluar->harga = $request->harga;
        $keluar->total_harga = $request->total_harga;
        $keluar->keterangan = $request->keterangan;
        if ($keluar->save()) {
            return redirect('/koperasi')->with('status','Pengeluaran berhasil dilakukan');
        } else {
            return redirect()->back()->with('status','Pengeluaran gagal dilakukan');
        }
        
    }

    public function editPengeluaran($id_pengeluaran){
        $data = [
            'pengeluaran'=> $this->PengeluaranKoperasi->where('id_pengeluaran',$id_pengeluaran)->first()
        ];
        return view('layouts.koperasi.editPengeluaran',$data);
    }
    
    public function updatePengeluaran(Request $request, $id_pengeluaran){
        $pengeluaran = PengeluaranKoperasi::find($id_pengeluaran);
        $pengeluaran->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglkeluar),
            'sumber_dana' => $request->sumber_dana,
            'pengeluaran' => $request->pengeluaran,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total_harga' => $request->total_harga,
            'keterangan' => $request->keterangan,
        ]);
        if ($pengeluaran->update()) {
            return redirect('/koperasi')->with('status','Data berhasil diedit');
        } else {
            return redirect('/koperasi')->with('statusdg','Data gagal diedit');
        }
        
    }

    public function destroyPengeluaran($id_pengeluaran){
        $pengeluaran = PengeluaranKoperasi::find($id_pengeluaran);
        if ($pengeluaran->delete()) {
            return redirect('/koperasi')->with('status','Data berhasil dihapus');
        } else {
            return redirect('/koperasi')->with('statusdg','Data gagal diedit');
        }
    }

    public function admin()
    {
        $data = [
            'admin'=>$this->User->admin()
        ];
        return view('auth.admin.admin',$data);
    }

    public function addAdmin()
    {
        return view('auth.admin.adminbaru');
    }

    protected function pushAdmin(Request $request){
        $rules=[
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $messages = [
            'name.required'      => 'Nama harus diisi!!!',
            'username.required'  => 'Username harus diisi !!!',
            'username.unique'  => 'Username sudah terpakai !!!',
            'password.required'  => 'Password harus diisi !!!',
            'password.confirmed'  => 'Password tidak cocok !!!'
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $user = new User();
        $user->level = 'admin';
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return redirect('/admin')->with('status','Admin berhasil ditambahkan');
        } else {
            return redirect()->back()->with('status','Admin gagal ditambahkan');
        }
        
    }

    public function mdata()
    {
        $mdata = DB::table('master_datas')->first();
        $jenis_simpanan = DB::table('jenis_simpanans')->get();
        $simpanan = Schema::getColumnListing('simpanans');
        return view('layouts.masterdata.mdata',compact('mdata','simpanan','jenis_simpanan'));
    }
    public function addmdata(Request $request)
    {
        $rules=[
            'qordh'=>'required|numeric|min:0|not_in:0',
            'keuntungan'=>'required|numeric|min:0',
            'danacadangan'=>'required|numeric|min:0',
            'danasosial'=>'required|numeric|min:0',
            'shupengurus' =>'required|numeric|min:0',
            'shuanggota' =>'required|numeric|min:0',
        ];
        $messages = [
            'qordh.required'=> 'Maksimal hutang wajib harus diisi !!!',
            'qordh.numeric' => 'Maksimal hutang wajib harus diisi dengan angka!!!',
            'qordh.min'     => 'Maksimal hutang wajib tidak boleh minus !!!',
            'qordh.not_in'  => 'Maksimal hutang wajib tidak boleh 0 !!!',
            'keuntungan.required'=> 'Prosentase keuntungan harus diisi !!!',
            'keuntungan.numeric' => 'Prosentase keuntungan harus diisi dengan angka!!!',
            'keuntungan.min'     => 'Prosentase keuntungan tidak boleh minus !!!',
            'danacadangan.required'=> 'Prosentase dana cadangan harus diisi !!!',
            'danacadangan.numeric' => 'Prosentase dana cadangan harus diisi dengan angka!!!',
            'danacadangan.min'     => 'Prosentase dana cadangan tidak boleh minus !!!',
            'danasosial.required'  => 'Prosentase dana sosial harus diisi !!!',
            'danasosial.numeric'   => 'Prosentase dana sosial harus diisi dengan angka!!!',
            'danasosial.min'       => 'Prosentase dana sosial tidak boleh minus !!!',
            'shupengurus.required' => 'SHU Pengurus harus diisi !!!',
            'shupengurus.numeric'  => 'SHU Pengurus harus diisi dengan angka!!!',
            'shupengurus.min'      => 'SHU Pengurus tidak boleh minus !!!',
            'shuanggota.required' => 'SHU Anggota harus diisi !!!',
            'shuanggota.numeric'  => 'SHU Anggota harus diisi dengan angka!!!',
            'shuanggota.required' => 'SHU Anggota harus diisi !!!',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $mdata = new MasterData();
        $mdata->qordh = $request->qordh;
        $mdata->prosentase_keuntungan = $request->keuntungan;
        $mdata->prosentase_danacadangan = $request->danacadangan;
        $mdata->prosentase_danasosial = $request->danasosial;
        $mdata->prosentase_shupengurus = $request->shupengurus;
        $mdata->prosentase_shuanggota = $request->shuanggota;
        if ($mdata->save()) {
            return redirect('/mdata')->with('status','Master data berhasil ditambahkan');
        } else {
            return redirect('/mdata')->with('statusdg','Master data gagal ditambahkan');
        }
    }
    public function editmdata($id)
    {
        $data = [
            'mdata'=> $this->MasterData->where('id',$id)->first()
        ];
        return view('layouts.masterdata.editmdata',$data);
    }
    public function updatemdata(Request $request,$id)
    {
        $mdata = MasterData::find($id);
        $mdata->update([
            'registrasi' => $request->registrasi,
            's_pokok' => $request->s_pokok,
            's_wajib' => $request->s_wajib,
            'qordh' => $request->qordh,
            'prosentase_keuntungan' => $request->keuntungan,
            'prosentase_danacadangan' => $request->danacadangan,
            'prosentase_danasosial' => $request->danasosial,
            'prosentase_shupengurus' => $request->shupengurus,
            'prosentase_shuanggota' => $request->shuanggota
        ]);
        if ($mdata->update()) {
            return redirect('/mdata')->with('status','Data berhasil diedit');
        } else {
            return redirect('/mdata')->with('statusdg','Data gagal diedit');
        }
    }
    
    public function addjenis()
    {
        return view('layouts.masterdata.addjenis');
    }
    public function pushjenis(Request $request)
    {
        $rules=[
            'new_simpanan'=>'required'
        ];
        $messages = [
            'new_simpanan.required'=> 'Masukan jenis simpanan baru !!!'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $jenis_simpanan = new JenisSimpanan();
        $jenis_simpanan->jenis_dana = $request->jenis_dana;
        $jenis_simpanan->kode_jenis = str_replace(' ','',$request->new_simpanan);
        $jenis_simpanan->kategori = $request->new_simpanan;
        if ($request->minimal == null) {
            $jenis_simpanan->minimal = 'Tidak ditentukan';
        } else {
            $jenis_simpanan->minimal = $request->minimal;
        }
        if ($request->maksimal == null) {
            $jenis_simpanan->maksimal = 'Tidak ditentukan';
        } else {
            $jenis_simpanan->maksimal = $request->maksimal;
        }
        if ($jenis_simpanan->save()) {
            return redirect('/mdata')->with('status','Jenis simpanan berhasil ditambahkan');
        } else {
            return redirect('/mdata')->with('statusdg','Jenis simpanan gagal ditambahkan');
        }
    }
    public function editjsimpanan($id_jenis)
    {
        $data = [
            'jenis_simpanan'=> $this->JenisSimpanan->where('id_jenis',$id_jenis)->first()
        ];
        return view('layouts.masterdata.editjsimpanan',$data);
    }
    public function updatejsimpanan(Request $request, $id_jenis)
    {
        $jenis_simpanan = JenisSimpanan::where('id_jenis',$id_jenis)->first();
        $jenis_simpanan->jenis_dana = $request->jenis_dana;
        $jenis_simpanan->kode_jenis = str_replace(' ','',$request->new_simpanan);
        $jenis_simpanan->kategori = $request->new_simpanan;
        if ($request->minimal == null) {
            $jenis_simpanan->minimal = 'Tidak ditentukan';
        } else {
            $jenis_simpanan->minimal = $request->minimal;
        }
        if ($request->maksimal == null) {
            $jenis_simpanan->maksimal = 'Tidak ditentukan';
        } else {
            $jenis_simpanan->maksimal = $request->maksimal;
        }
        if ($jenis_simpanan->update()) {
            return redirect('/mdata')->with('status','Data berhasil diedit');
        } else {
            return redirect('/mdata')->with('statusdg','Data gagal diedit');
        }
    }
    public function deletejsimpanan($id_jenis){
        $jenis_simpanan = JenisSimpanan::where('id_jenis',$id_jenis)->first();
        if ($jenis_simpanan->delete()) {
            return redirect('/mdata')->with('statusdg','Data berhasil dihapus');
        } else {
            return redirect('/mdata')->with('statusdg','Data gagal dihapus');
        }
    }

    public function pengurus()
    {
        $data = [
            'pengurus'=>$this->Pengurus->pengurus()
        ];
        return view('layouts.pengurus.pengurus',$data);
    }
    public function addpengurus()
    {
        return view('layouts.pengurus.tambah');
    }
    protected function pushpengurus(Request $request)
    {
        $rules=[
            'name'=>'required',
            'jabatan'=>'required',
            'tmlahir'=>'required',
            'tglahir'=>'required',
            'alamat'=>'required',
            'hp'=>'required|digits_between:11,13',
        ];
        $messages = [
            'name.required'      => 'Nama harus diisi !!!',
            'jabatan.required'   => 'Jabatan harus diisi !!!',
            'tmlahir.required'   => 'Tempat lahir harus diisi !!!',
            'tglahir.required'   => 'Tanggal lahir harus diisi !!!',
            'alamat.required'    => 'Alamat harus diisi !!!',
            'hp.required'        => 'No Handphone harus diisi !!!',
            'hp.digits_between'  => 'No Handphone harus 11 s.d 13 digit angka !!!',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $pengurus = new Pengurus();
        if ($request->jabatan=='Lainnya') {
            $pengurus->jabatan = $request->jabatanlain;
        } else {
            $pengurus->jabatan = $request->jabatan;
        }
        $pengurus->name = $request->name;
        $pengurus->tmlahir = $request->tmlahir;
        $pengurus->tglahir = Carbon::createFromFormat('d/m/Y', $request->tglahir);
        $pengurus->alamat = $request->alamat;
        $pengurus->hp = $request->hp;
        if ($pengurus->save()) {
            return redirect('/koperasi/pengurus')->with('status','Pengurus berhasil ditambahkan');
        } else {
            return redirect()->back()->with('status','Pengurus gagal ditambahkan');
        }
        
    }
    public function editpengurus($id)
    {
        $data = [
            'pengurus'=> $this->Pengurus->where('id',$id)->first()
        ];
        return view('layouts.pengurus.edit',$data);
    }
    public function updatepengurus(Request $request,$id)
    {
        $pengurus = Pengurus::find($id);
        if ($request->jabatan=='Lainnya') {
            $jabatan = $request->jabatanlain;
        } else {
            $jabatan = $request->jabatan;
        }
        $pengurus->update([
            'name' => $request->name,
            'jabatan' => $jabatan,
            'tmlahir' => $request->tmlahir,
            'tglahir' => Carbon::createFromFormat('d/m/Y', $request->tglahir),
            'alamat' => $request->alamat,
            'hp' => $request->hp,
        ]);
        if ($pengurus->update()) {
            return redirect('/koperasi/pengurus')->with('status','Data berhasil diedit');
        } else {
            return redirect('/koperasi/pengurus')->with('statusdg','Data gagal diedit');
        }
    }
    public function deletepengurus($id){
        $pengurus = Pengurus::find($id);
        if ($pengurus->delete()) {
            return redirect('/koperasi/pengurus')->with('status','Data berhasil dihapus');
        } else {
            return redirect('/koperasi/pengurus')->with('statusdg','Data gagal diedit');
        }
    }
}
