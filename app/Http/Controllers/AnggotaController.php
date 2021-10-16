<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\AngsuranKredit;
use App\Models\AngsuranMudorobah;
use App\Models\AngsuranQordh;
use App\Models\DataSimpanan;
use App\Models\JenisSimpanan;
use App\Models\KeuntunganMudorobah;
use App\Models\Kredit;
use App\Models\MasterData;
use App\Models\Mudorobah;
use App\Models\Penarikan;
use App\Models\Qordh;
use App\Models\Simpanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.anggota.anggota');
        
    }
    public function __construct()
    {
        $this->Anggota = new Anggota();
        $this->Simpanan = new Simpanan();
        $this->Penarikan = new Penarikan();
        $this->Kredit = new Kredit();
        $this->Qordh = new Qordh();
        $this->Mudorobah = new Mudorobah();
        $this->AngsuranKredit = new AngsuranKredit();
        $this->AngsuranQordh = new AngsuranQordh();
        $this->AngsuranMudorobah = new AngsuranMudorobah();
        $this->KeuntunganMudorobah = new KeuntunganMudorobah();
        $this->JenisSimpanan = new JenisSimpanan();
        $this->DataSimpanan = new DataSimpanan();
        $this->middleware('auth');
    }
    public function anggota(Request $request)
    {
        if ($request->has('cari')) {
            $anggota = Anggota::where('name','LIKE','%'.$request->cari.'%')->paginate(9);
        } else {
            $anggota = Anggota::latest()->paginate(9);
        }
        $jumlah_anggota = DB::table('anggotas')->count('id_anggota');
        return view('layouts.anggota.anggota',compact('anggota','jumlah_anggota'));
    }
    public function tambah()
    {
        $jenissimpanan = DB::table('jenis_simpanans')->first();
        $minregistrasi = DB::table('jenis_simpanans')->where('kategori','Registrasi')->value('minimal');
        $mins_pokok = DB::table('jenis_simpanans')->where('kategori','Simpanan Pokok')->value('minimal');
        $mins_wajib = DB::table('jenis_simpanans')->where('kategori','Simpanan Wajib')->value('minimal');
        $totalmdata = $minregistrasi + $mins_pokok + $mins_wajib;
        $anggota = DB::table('anggotas')->get('id_anggota')->last();
        // dd($anggota);
        return view('layouts.anggota.tambah',compact('jenissimpanan','minregistrasi','mins_pokok','mins_wajib','totalmdata','anggota'));
    }
    public function store(Request $request)
    {
        $rules=[
            'tgldaftar'=>'required',
            'id_anggota'=>'required|unique:anggotas',
            'name'=>'required',
            'tmlahir'=>'required',
            'tglahir'=>'required',
            'alamat'=>'required',
            'ktp'=>'required|numeric|unique:anggotas|digits:16|not_in:0',
            'pendidikan'=>'required',
            'pekerjaan'=>'required',
            'hp'=>'required|digits_between:11,13',
            'registrasi'=>'required|numeric|min:0|not_in:0',
            's_pokok'=>'required|numeric|min:0|not_in:0',
            's_wajib'=>'required|numeric|min:0|not_in:0',
        ];
        $messages = [
            'tgldaftar.required' => 'Tanggal harus diisi!!!',
            'id_anggota.required'=> 'No Anggota harus diisi!!!',
            'id_anggota.unique'  => 'No Anggota sudah ada !!!',
            'name.required'      => 'Nama harus diisi !!!',
            'tmlahir.required'   => 'Tempat lahir harus diisi !!!',
            'tglahir.required'   => 'Tanggal lahir harus diisi !!!',
            'alamat.required'    => 'Alamat harus diisi !!!',
            'ktp.required'       => 'No KTP harus diisi !!!',
            'ktp.numeric'        => 'No KTP harus diisi dengan angka!!!',
            'ktp.unique'         => 'No KTP sudah ada !!!',
            'ktp.digits'         => 'No KTP harus 16 digit angka !!!',
            'ktp.not_in'         => 'No KTP tidak boleh 0 !!!',
            'pendidikan.required'=> 'Pendidikan harus diisi !!!',
            'pekerjaan.required' => 'Pekerjaan harus diisi !!!',
            'hp.required'        => 'No Handphone harus diisi !!!',
            'hp.digits_between'  => 'No Handphone harus 11 s.d 13 digit angka !!!',
            'registrasi.required'=> 'Registrasi harus diisi !!!',
            'registrasi.numeric' => 'Registrasi harus diisi dengan angka!!!',
            'registrasi.min'     => 'Registrasi tidak boleh minus !!!',
            'registrasi.not_in'  => 'Registrasi tidak boleh 0 !!!',
            's_pokok.required'=> 'Simpanan pokok harus diisi !!!',
            's_pokok.numeric' => 'Simpanan pokok harus diisi dengan angka!!!',
            's_pokok.min'     => 'Simpanan pokok tidak boleh minus !!!',
            's_pokok.not_in'  => 'Simpanan pokok tidak boleh 0 !!!',
            's_wajib.required'=> 'Simpanan wajib harus diisi !!!',
            's_wajib.numeric' => 'Simpanan wajib harus diisi dengan angka!!!',
            's_wajib.min'     => 'Simpanan wajib tidak boleh minus !!!',
            's_wajib.not_in'  => 'Simpanan wajib tidak boleh 0 !!!',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $anggota = new Anggota();
        $anggota->tgldaftar = Carbon::createFromFormat('d/m/Y', $request->tgldaftar);
        $anggota->id_anggota = $request->id_anggota;
        $anggota->name = $request->name;
        $anggota->tmlahir = $request->tmlahir;
        $anggota->tglahir = Carbon::createFromFormat('d/m/Y', $request->tglahir);
        $anggota->alamat = $request->alamat;
        $anggota->ktp = $request->ktp;
        $anggota->pendidikan = $request->pendidikan;
        if ($request->pekerjaan=='Lainnya') {
            $anggota->pekerjaan = $request->pekerjaanlain;
        } else {
            $anggota->pekerjaan = $request->pekerjaan;
        }
        $anggota->hp = $request->hp;
        if ($request->file == null) {
            $anggota->image = 'avatar1.png';
        } else {
            $file = $request->file;
            $filename = time() . '.' . $file->extension();
            $file->move('uploads/avatars',$filename);
            $anggota->image = $filename;
        }
        if ($anggota->save()) {
            $data_simpanan = DB::table('data_simpanans')->orderBy('id_jumlah','desc')->first();
            if (empty($data_simpanan)) {
                $id_simpanan = 1;
            } else {
                $no = $data_simpanan->id_simpanan+1;
                $id_simpanan = sprintf($no++);
            }
            $data_simpanan = new DataSimpanan();
            $idregistrasi = JenisSimpanan::where('kategori', 'Registrasi')->value('id_jenis');
            $idpokok = JenisSimpanan::where('kategori', 'Simpanan Pokok')->value('id_jenis');
            $idwajib = JenisSimpanan::where('kategori', 'Simpanan Wajib')->value('id_jenis');
            $data = [
                ['id_simpanan'=>$id_simpanan, 'id_anggota'=>$request->id_anggota, 'id_jenis'=>$idregistrasi, 'kategori'=>'Registrasi', 'tgl'=>Carbon::createFromFormat('d/m/Y', $request->tgldaftar), 'jumlah_simpanan'=>$request->registrasi, 'keterangan'=>'Pendaftaran anggota baru'],
                ['id_simpanan'=>$id_simpanan, 'id_anggota'=>$request->id_anggota, 'id_jenis'=>$idpokok, 'kategori'=>'Simpanan Pokok', 'tgl'=>Carbon::createFromFormat('d/m/Y', $request->tgldaftar), 'jumlah_simpanan'=>$request->s_pokok, 'keterangan'=>'Pendaftaran anggota baru'],
                ['id_simpanan'=>$id_simpanan, 'id_anggota'=>$request->id_anggota, 'id_jenis'=>$idwajib, 'kategori'=>'Simpanan Wajib', 'tgl'=>Carbon::createFromFormat('d/m/Y', $request->tgldaftar), 'jumlah_simpanan'=>$request->s_wajib, 'keterangan'=>'Pendaftaran anggota baru'],
            ];
            if ($data_simpanan->insert($data)) {
                return redirect('/anggota')->with('status','Anggota berhasil ditambahkan');
            } else {
                return redirect('/anggota')->with('statuswn','Anggota berhasil ditambahkan, namun uang registrasi tidak masuk');
            }
        } else {
            return redirect('/anggota')->with('statusdg','Anggota gagal ditambahkan');
        }
    }
    public function detail($id_anggota)
    {
        $data = [
            'data_simpanan'=>$this->DataSimpanan->where('id_anggota',$id_anggota)->get(),
            'detail'=> $this->Anggota->detailAnggota($id_anggota),
            // 'totalTabungan'=>$this->Simpanan->where('anggota_id_anggota',$id_anggota)->where('kategori','Tabungan')->sum('jumlah_simpanan'),
            'totalTabungan'=>$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Tabungan')->sum('jumlah_simpanan'),
            'PenarikanTabungan'=>Penarikan::where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Umum')->sum('jumlah'),
            'PenarikanPendidikan'=>$this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Pendidikan')->sum('jumlah'),
            'PenarikanTHR'=>$this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','THR')->sum('jumlah'),
            'totalWajib'=>$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Wajib')->sum('jumlah_simpanan'),
            'totalPokok'=>$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Pokok')->sum('jumlah_simpanan'),
            'totalPendidikan'=>$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Pendidikan')->sum('jumlah_simpanan'),
            'totalTHR'=>$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Hari Raya')->sum('jumlah_simpanan'),
            // 'totalWajib'=>$this->Simpanan->where('anggota_id_anggota',$id_anggota)->sum('s_wajib'),
            // 'totalPokok'=>$this->Simpanan->where('anggota_id_anggota',$id_anggota)->sum('s_pokok'),
            // 'totalPendidikan'=>$this->Simpanan->where('anggota_id_anggota',$id_anggota)->sum('s_pendidikan'),
            // 'totalTHR'=>$this->Simpanan->where('anggota_id_anggota',$id_anggota)->sum('s_thr'),
            // 'simpanan'=>$this->Simpanan->joinAnggota()->where('id_anggota', $id_anggota),
            'penarikan'=>$this->Penarikan->joinAnggota()->where('id_anggota', $id_anggota),
            'kredit'=>$this->Kredit->joinAnggota()->where('id_anggota', $id_anggota),
            'qordh'=>$this->Qordh->joinAnggota()->where('id_anggota', $id_anggota),
            'mudorobah'=>$this->Mudorobah->joinAnggota()->where('id_anggota', $id_anggota),
            'keuntunganmudorobah'=>$this->KeuntunganMudorobah->joinAnggota()->where('id_anggota', $id_anggota),
            'angsuranKredit'=>$this->AngsuranKredit->joinAnggota()->where('id_anggota', $id_anggota),
            'angsuranQordh'=>$this->AngsuranQordh->joinAnggota()->where('id_anggota', $id_anggota),
            'angsuranMudorobah'=>$this->AngsuranMudorobah->joinAnggota()->where('id_anggota', $id_anggota),
            'sisaKredit'=>$this->Kredit->where('no_anggota',$id_anggota)->sum('sisa_kredit'),
            'sisaQordh'=>$this->Qordh->where('no_anggota',$id_anggota)->sum('sisa_qordh'),
            'sisaMudorobah'=>$this->Mudorobah->where('no_anggota',$id_anggota)->sum('sisa_hutang'),
            'totalMudorobah'=>$this->Mudorobah->where('no_anggota',$id_anggota)->sum('jumlah'),
            'totalAngsuranKredit'=>$this->AngsuranKredit->where('no_anggota',$id_anggota)->sum('jumlah_angsuran'),
            'totalAngsuranQordh'=>$this->AngsuranQordh->where('no_anggota',$id_anggota)->sum('jumlah_angsuran'),
            'totalAngsuranMudorobah'=>$this->AngsuranMudorobah->where('no_anggota',$id_anggota)->sum('jumlah_angsuran'),
            // 'datasimpananjoin'=>$this->DataSimpanan->joinData()->where('id_anggota', $id_anggota),
        ];
        $datasimpanan = DataSimpanan::where('id_anggota', $id_anggota)->latest()->paginate(9);
        return view('layouts.anggota.profile',$data,compact('datasimpanan'));
    }
    public function edit($id_anggota)
    {
        $data = [
            'detail'=> $this->Anggota->detailAnggota($id_anggota),
        ];
        return view('layouts.anggota.edit',$data);
    }
    public function update(Request $request)
    {         
        $anggota = DB::table('anggotas')->where('id_anggota',$request->id_anggota);
        if ($request->file == null) {
            $filename = DB::table('anggotas')->where('id_anggota',$request->id_anggota)->value('image');
        } else {
            $file = $request->file;
            $filename = time() . '.' . $file->extension();
            $file->move('uploads/avatars',$filename);
        }
        $anggota->update([
            'name'=>$request->name,
            'tmlahir'=>$request->tmlahir,
            'tglahir'=>Carbon::createFromFormat('d/m/Y', $request->tglahir),
            'alamat'=>$request->alamat,
            'ktp'=>$request->ktp,
            'pendidikan'=>$request->pendidikan,
            'pekerjaan'=>$request->pekerjaan,
            'hp'=>$request->hp,
            'image'=> $filename
        ]);
        return redirect('/anggota')->with('statusupdate');
    }
    public function destroy($id)
    {
        $anggota = Anggota::find($id);
        if ($anggota->delete()) {
            return redirect('/anggota')->with('status','Data berhasil dihapus');
        } else {
            return redirect('/anggota')->with('statusdg','Data gagal dihapus');
        }
        
    }

    public function editSimpanan($id_jumlah)
    {
        $data = [
            'datasimpanan'=>$this->DataSimpanan->joinAnggota()->where('id_jumlah', $id_jumlah)->first()
        ];
        return view('layouts.profile.editsimpanan',$data);
    }
    public function updateSimpanan(Request $request, $id)
    { 
            $kategori = DB::table('jenis_simpanans')->get('kategori')->toArray();
            foreach ($kategori as $key) {
                $str_json = json_encode($key);
                $fixkode = substr($str_json,13,-2);
                $notreplace = preg_split('/(?=[A-Z])/', $fixkode, -1, PREG_SPLIT_NO_EMPTY);
                $notreplaces = join(" ",$notreplace);
                $jumlah_simpanan = request($fixkode);
                if ($jumlah_simpanan == null) {
                } elseif ($jumlah_simpanan == 0) {
                } else {
                    $ide=$request->id_anggota;
                    $data_simpanan = new DataSimpanan();
                    $idjenis = DB::table('jenis_simpanans')->where('kategori',$notreplaces)->value('id_jenis');
                    // $data = [
                    //     ['id_anggota'=>$ide, 'id_jenis'=>$idjenis, 'kategori'=>$notreplaces, 'tgl'=>Carbon::createFromFormat('d/m/Y', $request->tglsetor), 'jumlah_simpanan'=>$jumlah_simpanan, 'keterangan'=>$request->keterangan]
                    // ];
                    // $arraydata = json_encode($data);
                    $data_simpanan->id_anggota = $ide;
                    $data_simpanan->id_jenis = $idjenis;
                    $data_simpanan->kategori = $notreplaces;
                    $data_simpanan->tgl = Carbon::createFromFormat('d/m/Y', $request->tglsetor);
                    $data_simpanan->jumlah_simpanan = $jumlah_simpanan;
                    $data_simpanan->keterangan = $request->keterangan;

                    $data_simpanan->update();
                }
            }
        return redirect()->route('profile', [$request->id_anggota])->with('status','Data simpanan berhasil dirubah');
    }
    public function destroySimpanan($id_jumlah)
    {
        $datasimpanan=DataSimpanan::where('id_jumlah',$id_jumlah);
        $datasimpanan->delete();
        return redirect()->back()->with('statusdg','Data berhasil dihapus');
    }

    public function editPenarikan($id)
    {
        $data = [
            'penarikan'=>$this->Penarikan->joinAnggota()->where('id_penarikan', $id)->first()
        ];
        return view('layouts.profile.editPenarikan',$data);       
    }
    public function updatePenarikan(Request $request, $id)
    {
        
        $penarikan=Penarikan::find($id);
        $penarikan->update([
            'tgl'=>Carbon::createFromFormat('d/m/Y', $request->tgltarik),
            'jumlah'=>$request->jumlah,
            'catatan'=>$request->catatan
        ]);
        return redirect()->route('profile', [$request->id_anggota])->with('status','Data simpanan berhasil dirubah');
    }
    public function destroyPenarikan($id)
    {
        $penarikan=penarikan::find($id)->where('id_penarikan',$id);
        $penarikan->delete();
        return redirect()->back()->with('statusdg','Data berhasil dihapus');
    }

    public function editKredit($id)
    {
        $data = [
            'kredit'=>$this->Kredit->where('id_kredit',$id)->first(),
            'kredits'=>$this->Kredit->joinAnggota()->where('id_kredit',$id)->first()
        ];
        return view('layouts.profile.editKredit',$data);
    }
    public function updateKredit(Request $request, $id)
    {
        $kredit = Kredit::find($id);
        $keuntungan = MasterData::value('prosentase_keuntungan');
        $kredit->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglhutang),
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total_harga'=> $request->jumlah*$request->harga,
            'maximal_angsuran' => $request->maximal_angsuran,
            'lama_angsuran' => $request->lama_angsuran,
            'jatuh_tempo' => Carbon::createFromFormat('d/m/Y', $request->jatuh_tempo),
            'total_kredit' => ((($request->lama_angsuran/$request->maximal_angsuran)*$keuntungan/100)*($request->jumlah*$request->harga))+(($request->jumlah*$request->harga)),
            'sisa_kredit' => ((($request->lama_angsuran/$request->maximal_angsuran)*$keuntungan/100)*($request->jumlah*$request->harga))+(($request->jumlah*$request->harga)),
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('profile', [$request->id_anggota])->with('status','Data Berhasil Dirubah');
    }
    public function destroyKredit($id)
    {
        $kredit=Kredit::find($id)->where('id_kredit',$id);
        $kredit->delete();
        return redirect()->back()->with('statusdg','Data berhasil dihapus');
    }

    public function editQordh($id)
    {
        $data = [
            'qordh'=>$this->Qordh->where('id_qordh',$id)->first(),
            'qordhs'=>$this->Qordh->joinAnggota()->where('id_qordh',$id)->first()
        ];
        return view('layouts.profile.editQordh',$data);
    }
    public function updateQordh(Request $request, $id)
    {
        $qordh=Qordh::find($id);
        $qordh->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglhutang),
            'jumlah' => $request->jumlah,
            'lama_angsuran' => $request->lama_angsuran,
            'jatuh_tempo' => Carbon::createFromFormat('d/m/Y', $request->jatuh_tempo),
            'sisa_qordh' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('profile', [$request->id_anggota])->with('status','Data Berhasil Dirubah');
    }
    public function destroyQordh($id)
    {
        $qordh=Qordh::find($id)->where('id_qordh',$id);
        $qordh->delete();
        return redirect()->back()->with('statusdg','Data berhasil dihapus');
    }

    public function editMudorobah($id)
    {
        $data = [
            'mudorobah'=>$this->Mudorobah->where('id_mudorobah',$id)->first(),
            'mudorobahs'=>$this->Mudorobah->joinAnggota()->where('id_mudorobah',$id)->first()
        ];
        $anggotas = DB::table('anggotas')->get();
        $penguruses = DB::table('penguruses')->get();
        return view('layouts.profile.editMudorobah',$data,compact('anggotas','penguruses'));
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
            'sisa_hutang' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('profile', [$request->id_anggota])->with('status','Data Berhasil Dirubah');
    }
    public function destroyMudorobah($id)
    {
        $mudorobah=Mudorobah::find($id)->where('id_mudorobah',$id);
        $mudorobah->delete();
        return redirect()->back()->with('statusdg','Data berhasil dihapus');
    }

    public function editKeuntungan($id)
    {
        $data=[
            'keuntungan'=>$this->KeuntunganMudorobah->where('id_keuntungan',$id)->first(),
            'keuntungans'=>$this->KeuntunganMudorobah->joinAnggota()->where('id_keuntungan',$id)->first()
        ];
        return view('layouts.profile.editKeuntungan',$data);
    }
    public function updateKeuntungan(Request $request, $id)
    {
        $keuntungan = KeuntunganMudorobah::find($id);
        $mudorobah = Mudorobah::find($keuntungan->id_mudorobah);
        $jumlah = $request->laba_usaha * $mudorobah->bagi_hasil / 100;
        $keuntungan->update([
            'tgl' => Carbon::createFromFormat('d/m/Y', $request->tglsetor),
            'laba_usaha' => $request->laba_usaha,
            'jumlah'=> $jumlah,
            'prosentase_danacadangan' => $request->prosentase_danacadangan,
            'prosentase_danasosial' => $request->prosentase_danasosial,
            'prosentase_shupengurus' => $request->prosentase_shupengurus,
            'prosentase_shuanggota' => $request->prosentase_shuanggota,
            'masuk_danacadangan' => $jumlah * $request->prosentase_danacadangan/100,
            'masuk_danasosial' => $jumlah * $request->prosentase_danasosial/100,
            'masuk_shupengurus' => $jumlah * $request->prosentase_shupengurus/100,
            'masuk_shuanggota' => $jumlah * $request->prosentase_shuanggota/100,
            'keterangan' => $request->keterangan
        ]);
        if ($keuntungan->update()) {
            return redirect()->route('profile', [$request->id_anggota])->with('status','Data Berhasil Dirubah');
        } else {
            return redirect()->route('profile', [$request->id_anggota])->with('statusdg','Data Gagal Dirubah');
        }
    }
    public function destroyKeuntungan($id)
    {
        $keuntungan = KeuntunganMudorobah::find($id);
            // Delete data angsuran anggota
        if ($keuntungan->delete()) {
        return redirect()->back()->with('statusdg','Data berhasil dihapus');
        } else {
        return redirect()->back()->with('statusdg','Data gagal dihapus');
        }
    }

    public function editAngsurankredit($id)
    {
        $data=[
            'angsuran'=>$this->AngsuranKredit->where('id_angsuran_kredit',$id)->first(),
            'angsurans'=>$this->AngsuranKredit->joinAnggota()->where('id_angsuran_kredit',$id)->first(),
            'kredit'=>$this->AngsuranKredit->joinKredit()->where('id_angsuran_kredit',$id)->first()
        ];
        return view('layouts.profile.editAngsurankredit',$data);
    }
    public function updateAngsurankredit(Request $request, $id)
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
            return redirect()->route('profile', [$request->id_anggota])->with('status','Data berhasil dirubah & sisa kredit berubah');
        } else {
            return redirect()->route('profile', [$request->id_anggota])->with('statusdg','Data gagal dirubah');
        }
        
    }
    public function destroyAngsurankredit($id)
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
            return redirect()->back()->with('statusdg','Data berhasil dihapus');
        } else {
            return redirect()->back()->with('statusdg','Data gagal dihapus');
        }
    }

    public function editAngsuranqordh($id)
    {
        $data=[
            'angsuran'=>$this->AngsuranQordh->where('id_angsuran_qordh',$id)->first(),
            'angsurans'=>$this->AngsuranQordh->joinAnggota()->where('id_angsuran_qordh',$id)->first(),
            'qordh'=>$this->AngsuranQordh->joinQordh()->where('id_angsuran_qordh',$id)->first()
        ];
        return view('layouts.profile.editAngsuranqordh',$data);
    }
    public function updateAngsuranqordh(Request $request, $id)
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

            return redirect()->route('profile', [$request->id_anggota])->with('status','Data berhasil dirubah & sisa hutang berubah');
            return redirect('/angsuran/qordh')->with('status','Data Berhasil Dirubah');
        } else {
            return redirect()->route('profile', [$request->id_anggota])->with('statusdg','Data gagal dirubah');
        }
    }
    public function destroyAngsuranqordh($id)
    {
        $angsuran=AngsuranQordh::find($id);
        $qordh = Qordh::where('id_qordh',$angsuran->id_qordh)->first();
            // Delete data angsuran anggota
        if ($angsuran->delete()) {
            // Update data qordh anggota
            $qordh->sisa_qordh = $qordh->sisa_qordh + $angsuran->jumlah_angsuran;
            $qordh->update();
            return redirect()->back()->with('statusdg','Data berhasil dihapus');
        } else {
            return redirect()->back()->with('statusdg','Data gagal dihapus');
        }
    }

    public function editAngsuranmudorobah($id)
    {
        $data=[
            'angsuran'=>$this->AngsuranMudorobah->where('id_angsuran_mudorobah',$id)->first(),
            'angsurans'=>$this->AngsuranMudorobah->joinAnggota()->where('id_angsuran_mudorobah',$id)->first()
        ];
        return view('layouts.profile.editAngsuranmudorobah',$data);
    }
    public function updateAngsuranmudorobah(Request $request, $id)
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
            return redirect()->route('profile', [$request->id_anggota])->with('status','Data berhasil dirubah & sisa mudorobah berubah');
        } else {
            return redirect()->route('profile', [$request->id_anggota])->with('statusdg','Data gagal dirubah & sisa mudorobah berubah');
        }
        
    }
    public function destroyAngsuranmudorobah($id)
    {
        $angsuran=AngsuranMudorobah::find($id);
        $mudorobah = Mudorobah::where('id_mudorobah',$angsuran->id_mudorobah)->first();
        if ($angsuran->delete()) {
            // Update data qordh anggota
            $mudorobah->sisa_hutang = $mudorobah->sisa_hutang + $angsuran->jumlah_angsuran;
            $mudorobah->update();
            return redirect()->back()->with('statusdg','Data berhasil dihapus');
        } else {
            return redirect()->back()->with('statusdg','Data gagal dihapus');
        }
    }

    public function printDebit(Request $request, $id_anggota){
        $today = Carbon::now()->toDateString();
        // $today = Carbon::createFromFormat('d/m/Y', $request->tgltrx)->toDateString();
        //versi data masuk semua
        // $wajib = DataSimpanan::where('id_anggota',$id_anggota)->where('kategori','Simpanan Wajib')->first();
        // $thr = DataSimpanan::where('id_anggota',$id_anggota)->where('kategori','Simpanan HaRi Raya')->first();
        // $pendidikan = DataSimpanan::where('id_anggota',$id_anggota)->where('kategori','Simpanan Pendidikan')->first();
        // $tabung = DataSimpanan::where('id_anggota',$id_anggota)->where('kategori','Tabungan')->first();
        // if ($wajib == null) {
        //     $s_wajib = 0;
        // } elseif ($thr == null){
        //     $s_thr = 0;
        // } elseif ($pendidikan == null) {
        //     $s_pendidikan = 0;
        // } elseif ($tabung == null) {
        //     $tabungan = 0;
        // } else {
        //     $s_wajib = DataSimpanan::where('id_anggota',$id_anggota)->where('kategori','Simpanan Wajib')->orderBy('jumlah_simpanan', 'DESC')->first();
        //     $s_thr = DataSimpanan::where('id_anggota',$id_anggota)->where('kategori','Simpanan HaRi Raya')->orderBy('jumlah_simpanan', 'DESC')->first();
        //     $s_pendidikan = DataSimpanan::where('id_anggota',$id_anggota)->where('kategori','Simpanan Pendidikan')->orderBy('jumlah_simpanan', 'DESC')->first();
        //     $tabungan = DataSimpanan::where('id_anggota',$id_anggota)->where('kategori','Tabungan')->orderBy('created_at', 'DESC')->first();
        // }
        //versi lain
        $wajib = DataSimpanan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('kategori','Simpanan Wajib')->first();
        $thr = DataSimpanan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('kategori','Simpanan HaRi Raya')->first();
        $pendidikan = DataSimpanan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('kategori','Simpanan Pendidikan')->first();
        $tabung = DataSimpanan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('kategori','Tabungan')->first();
        if ($wajib == null) {
            $s_wajib = 0;
        } if ($thr == null){
            $s_thr = 0;
        } if ($pendidikan == null) {
            $s_pendidikan = 0;
        } if ($tabung == null) {
            $tabungan = 0;
        } else {
            $swajib = DataSimpanan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('kategori','Simpanan Wajib')->orderBy('jumlah_simpanan', 'DESC')->first();
            $sthr = DataSimpanan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('kategori','Simpanan HaRi Raya')->orderBy('jumlah_simpanan', 'DESC')->first();
            $spendidikan = DataSimpanan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('kategori','Simpanan Pendidikan')->orderBy('jumlah_simpanan', 'DESC')->first();
            $stabungan = DataSimpanan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('kategori','Tabungan')->orderBy('jumlah_simpanan', 'DESC')->first();
        }
        if ($swajib == null) {
            $s_wajib = 0;
        } else {
            $s_wajib = $swajib->jumlah_simpanan;
        }
        if ($sthr == null) {
            $s_thr = 0;
        } else {
            $s_thr = $sthr->jumlah_simpanan;
        }
        if ($spendidikan == null) {
            $s_pendidikan = 0;
        } else {
            $s_pendidikan = $spendidikan->jumlah_simpanan;
        }
        if ($stabungan == null) {
            $tabungan = 0;
        } else {
            $tabungan = $stabungan->jumlah_simpanan;
        }
        //angsuran
        
        $angsurankredit = $this->AngsuranKredit->joinAnggota()->where('id_anggota',$id_anggota)->first();
            if ($angsurankredit == null) {
                $jumlahakredit = 0;
            } else {
                $jumlahakredit = $angsurankredit;
            }
        $angsuranqordh = $this->AngsuranQordh->joinAnggota()->where('id_anggota',$id_anggota)->first();
            if ($angsuranqordh == null) {
                $jumlahaqordh = 0;
            } else {
                $jumlahaqordh = $angsuranqordh;
            }
        $angsuranmudorobah = $this->AngsuranMudorobah->joinAnggota()->where('id_anggota',$id_anggota)->first();
            if ($angsuranmudorobah == null) {
                $jumlahamudorobah = 0;
            } else {
                $jumlahamudorobah = $angsuranmudorobah;
            }
        
            $totTabungan=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Tabungan')->sum('jumlah_simpanan');
            $PenarikanTabungan=$this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Umum')->sum('jumlah');
            $PenarikanPendidikan=$this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Pendidikan')->sum('jumlah');
            $PenarikanTHR=$this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','THR')->sum('jumlah');
            $totalWajib=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Wajib')->sum('jumlah_simpanan');
            $totalPokok=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Pokok')->sum('jumlah_simpanan');
            $totPendidikan=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Pendidikan')->sum('jumlah_simpanan');
            $totTHR=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Hari Raya')->sum('jumlah_simpanan');
            $totalTabungan = $totTabungan - $PenarikanTabungan;
            $totalTHR = $totTHR - $PenarikanTHR;
            $totalPendidikan = $totPendidikan - $PenarikanPendidikan;
            $totalWajibPokok = $totalWajib + $totalPokok;
        return view('layouts.print.tabungan-print', compact('today','jumlahakredit','jumlahaqordh',
        'jumlahamudorobah','totalWajibPokok','totalTabungan','totalWajib','totalPokok',
        'totalPendidikan','totalTHR','s_wajib','s_thr','s_pendidikan','tabungan'));
    }
    
    // public function printKredit($id_anggota){

    //     // $today = Carbon::now();
    //     // $tabung= DB::table('penarikans')->where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Umum')->first();
    //     // $pendidikan=DB::table('penarikans')->where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Pendidikan')->first();
    //     // $thr=DB::table('penarikans')->where('no_anggota',$id_anggota)->where('jenis_penarikan','THR')->first();
    //     // if ($thr == null){
    //     //     $s_thr = 0;
    //     // } elseif ($pendidikan == null) {
    //     //     $s_pendidikan = 0;
    //     // } elseif ($tabung == null) {
    //     //     $tabungan = 0;
    //     // } else {
    //     //     $s_thr = $this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','THR')->sum('jumlah');
    //     //     $s_pendidikan = Penarikan::where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Pendidikan')->sum('jumlah');
    //     //     $tabungan = $this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Umum')->sum('jumlah');
    //     // }
    //     $today = Carbon::createFromFormat('d/m/Y', $request->tgltrx)->toDateString();
    //     $thr = Penarikan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('jenis_penarikan','THR')->first();
    //     $pendidikan = Penarikan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('jenis_penarikan','Tabungan Pendidikan')->first();
    //     $tabung = Penarikan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('jenis_penarikan','Tabungan Umum')->first();
    //     if ($wajib == null) {
    //         $s_wajib = 0;
    //     } if ($thr == null){
    //         $s_thr = 0;
    //     } if ($pendidikan == null) {
    //         $s_pendidikan = 0;
    //     } if ($tabung == null) {
    //         $tabungan = 0;
    //     } else {
    //         $sthr = Penarikan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('jenis_penarikan','THR')->orderBy('jumlah', 'DESC')->first();
    //         $spendidikan = Penarikan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('jenis_penarikan','Tabungan Pendidikan')->orderBy('jumlah', 'DESC')->first();
    //         $stabungan = Penarikan::where('id_anggota',$id_anggota)->where('tgl',$today)->where('jenis_penarikan','Tabungan Umum')->orderBy('jumlah', 'DESC')->first();
    //     }
    //     if ($swajib == null) {
    //         $s_wajib = 0;
    //     } else {
    //         $s_wajib = $swajib->jumlah_simpanan;
    //     }
    //     if ($sthr == null) {
    //         $s_thr = 0;
    //     } else {
    //         $s_thr = $sthr->jumlah_simpanan;
    //     }
    //     if ($spendidikan == null) {
    //         $s_pendidikan = 0;
    //     } else {
    //         $s_pendidikan = $spendidikan->jumlah_simpanan;
    //     }
    //     if ($stabungan == null) {
    //         $tabungan = 0;
    //     } else {
    //         $tabungan = $stabungan->jumlah_simpanan;
    //     }
    //         $s_wajib = 0;
    //         $angsuran = 0;
    //         $totTabungan=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Tabungan')->sum('jumlah_simpanan');
    //         $PenarikanTabungan=$this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Umum')->sum('jumlah');
    //         $PenarikanPendidikan=$this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','Tabungan Pendidikan')->sum('jumlah');
    //         $PenarikanTHR=$this->Penarikan->where('no_anggota',$id_anggota)->where('jenis_penarikan','THR')->sum('jumlah');
    //         $totalWajib=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Wajib')->sum('jumlah_simpanan');
    //         $totalPokok=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Pokok')->sum('jumlah_simpanan');
    //         $totPendidikan=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Pendidikan')->sum('jumlah_simpanan');
    //         $totTHR=$this->DataSimpanan->where('id_anggota',$id_anggota)->where('kategori','Simpanan Hari Raya')->sum('jumlah_simpanan');
    //         $totalTabungan = $totTabungan - $PenarikanTabungan;
    //         $totalTHR = $totTHR - $PenarikanTHR;
    //         $totalPendidikan = $totPendidikan - $PenarikanPendidikan;
    //         $totalWajibPokok = $totalWajib + $totalPokok;
        
    //         return view('layouts.print.kredits-print', compact('today','s_wajib','totalWajib','totalPokok','s_thr','totalTHR','s_pendidikan','totalPendidikan','tabungan','totalTabungan','angsuran'));
    // }
}
