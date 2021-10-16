<?php

namespace App\Http\Controllers;

use App\Models\AngsuranKredit;
use App\Models\AngsuranMudorobah;
use App\Models\AngsuranQordh;
use App\Models\KeuntunganMudorobah;
use App\Models\Kredit;
use App\Models\Mudorobah;
use App\Models\PemasukanKoperasi;
use App\Models\Penarikan;
use App\Models\PengeluaranKoperasi;
use App\Models\Qordh;
use App\Models\Simpanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //
    
    public function __construct()
    {        
        $this->Simpanan = new Simpanan();
        $this->Kredit = new Kredit();
        $this->Qordh = new Qordh();
        $this->Mudorobah = new Mudorobah();
        $this->PemasukanKoperasi = new PemasukanKoperasi();
        $this->PengeluaranKoperasi = new PengeluaranKoperasi;
        $this->KeuntunganMudorobah = new KeuntunganMudorobah();
        $this->AngsuranKredit = new AngsuranKredit();
        $this->User = new User();
        $this->middleware('auth');
    }

    public function index()
    {
        $startDate = today()->subDays(7);
        $endDate = today();
        //Dana Masuk
        $pemasukanKoperasi = PemasukanKoperasi::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');
        $simpanantabungan = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('tabungan');
        $simpanans_wajib = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('s_wajib');
        $simpanans_thr = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('s_thr');
        $simpanans_pendidikan = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('s_pendidikan');
        $simpanans_pokok = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('s_pokok');
        $simpananregistrasi = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('registrasi');
        $angsurankredit = AngsuranKredit::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah_angsuran');
        $angsuranqordh = AngsuranQordh::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah_angsuran');
        $angsuranmudorobah = AngsuranMudorobah::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah_angsuran');
        $keuntungan = KeuntunganMudorobah::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');
        
        $totalpemasukan = $pemasukanKoperasi + $simpanantabungan + $simpanans_wajib + $simpanans_thr
                        + $simpanans_pendidikan + $simpanans_pokok + $simpananregistrasi + $angsurankredit 
                        + $angsuranqordh + $angsuranmudorobah + $keuntungan;
        //Dana Keluar 
        $pengeluarankoperasi = PengeluaranKoperasi::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('total_harga');
        $penarikan = Penarikan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');
        $kredit = Kredit::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('total_harga');
        $qordh = Qordh::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');
        $mudorobah = Mudorobah::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');

        $totalpengeluaran = $pengeluarankoperasi + $penarikan + $kredit + $qordh + $mudorobah;
        return view('dashboard',compact('totalpemasukan','totalpengeluaran','startDate','endDate'));
        // dd($pemasukan);
    }
    public function daterange(Request $request)
    {
        $startDate = Carbon::createFromFormat('d/m/Y', $request->datefrom);
        $endDate = Carbon::createFromFormat('d/m/Y', $request->dateto);
        //Dana Masuk
        $pemasukanKoperasi = PemasukanKoperasi::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');
        $simpanantabungan = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('tabungan');
        $simpanans_wajib = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('s_wajib');
        $simpanans_thr = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('s_thr');
        $simpanans_pendidikan = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('s_pendidikan');
        $simpanans_pokok = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('s_pokok');
        $simpananregistrasi = Simpanan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('registrasi');
        $angsurankredit = AngsuranKredit::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah_angsuran');
        $angsuranqordh = AngsuranQordh::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah_angsuran');
        $angsuranmudorobah = AngsuranMudorobah::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah_angsuran');
        $keuntungan = KeuntunganMudorobah::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');
        
        $totalpemasukan = $pemasukanKoperasi + $simpanantabungan + $simpanans_wajib + $simpanans_thr
                        + $simpanans_pendidikan + $simpanans_pokok + $simpananregistrasi + $angsurankredit 
                        + $angsuranqordh + $angsuranmudorobah + $keuntungan;
        //Dana Keluar 
        $pengeluarankoperasi = PengeluaranKoperasi::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('total_harga');
        $penarikan = Penarikan::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');
        $kredit = Kredit::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('total_harga');
        $qordh = Qordh::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');
        $mudorobah = Mudorobah::where('tgl', '>=', $startDate)->where('tgl', '<=', $endDate)->get()->sum('jumlah');

        $totalpengeluaran = $pengeluarankoperasi + $penarikan + $kredit + $qordh + $mudorobah;
        return view('dashboard',compact('totalpemasukan','totalpengeluaran','startDate','endDate'));
    }
}
