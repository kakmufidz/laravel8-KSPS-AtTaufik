<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PenarikanController;
use App\Http\Controllers\AkadController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KoperasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/tambahadmin', [RegisterController::class,'adminbaru']);

Route::group(['middleware' => ['auth','ceklevel:superadmin']], function () {
    Route::get('/admin', [KoperasiController::class,'admin']);
    Route::get('/admin/tambah', [KoperasiController::class,'addAdmin']);
    Route::post('/admin/tambah', [KoperasiController::class,'pushAdmin']);
    Route::get('/admin/edit/{id}', [KoperasiController::class,'editadmin']);
});

Route::get('/', [DashboardController::class,'index']);
Route::get('/dashboard', [DashboardController::class,'index']);
Route::post('/dashboard/daterange', [DashboardController::class,'daterange']);
Route::get('/anggota', [AnggotaController::class,'anggota']);
Route::get('/anggota/tambah', [AnggotaController::class,'tambah']);
Route::post('/anggota/tambah', [AnggotaController::class,'store']);
Route::get('/anggota/edit/{id_anggota}', [AnggotaController::class,'edit']);
Route::post('/anggota/update/{id_anggota}', [AnggotaController::class,'update']);
Route::get('/anggota/hapus/{id_anggota}', [AnggotaController::class,'destroy']);
Route::get('/anggota/profile/{id_anggota}', [AnggotaController::class,'detail'])->name('profile');
Route::get('/tabungan/print/debit/{id_anggota}', [AnggotaController::class,'printDebit']);
Route::get('/tabungan/print/kredit/{id_anggota}', [AnggotaController::class,'printKredit']);

Route::get('/anggota/profile/editsimpanan/{id_simpanan}', [AnggotaController::class,'editSimpanan']);
Route::post('/anggota/profile/updatesimpanan/{id_simpanan}', [AnggotaController::class,'updateSimpanan']);
Route::get('/anggota/profile/hapussimpanan/{id_simpanan}', [AnggotaController::class,'destroySimpanan']);

Route::get('/anggota/profile/editpenarikan/{id_penarikan}', [AnggotaController::class,'editPenarikan']);
Route::post('/anggota/profile/updatepenarikan/{id_penarikan}', [AnggotaController::class,'updatePenarikan']);
Route::get('/anggota/profile/hapuspenarikan/{id_penarikan}', [AnggotaController::class,'destroyPenarikan']);

Route::get('/anggota/profile/editkredit/{id_kredit}', [AnggotaController::class,'editKredit']);
Route::post('/anggota/profile/updatekredit/{id_kredit}', [AnggotaController::class,'updateKredit']);
Route::get('/anggota/profile/hapuskredit/{id_kredit}', [AnggotaController::class,'destroyKredit']);

Route::get('/anggota/profile/editqordh/{id_qordh}', [AnggotaController::class,'editQordh']);
Route::post('/anggota/profile/updateqordh/{id_qordh}', [AnggotaController::class,'updateQordh']);
Route::get('/anggota/profile/hapusqordh/{id_qordh}', [AnggotaController::class,'destroyQordh']);

Route::get('/anggota/profile/editmudorobah/{id_mudorobah}', [AnggotaController::class,'editMudorobah']);
Route::post('/anggota/profile/updatemudorobah/{id_mudorobah}', [AnggotaController::class,'updateMudorobah']);
Route::get('/anggota/profile/hapusmudorobah/{id_mudorobah}', [AnggotaController::class,'destroyMudorobah']);

Route::get('/anggota/profile/editkeuntungan/{id_keuntungan}', [AnggotaController::class,'editKeuntungan']);
Route::post('/anggota/profile/updatekeuntungan/{id_keuntungan}', [AnggotaController::class,'updateKeuntungan']);
Route::get('/anggota/profile/hapuskeuntungan/{id_keuntungan}', [AnggotaController::class,'destroyKeuntungan']);

Route::get('/anggota/profile/editangsurankredit/{id_angsuran}', [AnggotaController::class,'editAngsurankredit']);
Route::post('/anggota/profile/updateangsurankredit/{id_angsuran}', [AnggotaController::class,'updateAngsurankredit']);
Route::get('/anggota/profile/hapusangsurankredit/{id_angsuran}', [AnggotaController::class,'destroyAngsurankredit']);

Route::get('/anggota/profile/editangsuranqordh/{id_angsuran}', [AnggotaController::class,'editAngsuranqordh']);
Route::post('/anggota/profile/updateangsuranqordh/{id_angsuran}', [AnggotaController::class,'updateAngsuranqordh']);
Route::get('/anggota/profile/hapusangsuranqordh/{id_angsuran}', [AnggotaController::class,'destroyAngsuranqordh']);

Route::get('/anggota/profile/editangsuranmudorobah/{id_angsuran}', [AnggotaController::class,'editAngsuranmudorobah']);
Route::post('/anggota/profile/updateangsuranmudorobah/{id_angsuran}', [AnggotaController::class,'updateAngsuranmudorobah']);
Route::get('/anggota/profile/hapusangsuranmudorobah/{id_angsuran}', [AnggotaController::class,'destroyAngsuranmudorobah']);

Route::get('/simpanan', [SimpananController::class,'simpan']);
Route::get('/simpanan/tambah/{id_anggota}',[SimpananController::class,'tambah']);
Route::post('/simpanan/tambah',[SimpananController::class,'pushTambah']);
Route::get('/simpanan/edit/{id_simpanan}',[SimpananController::class,'edit']);
Route::post('/simpanan/update/{id_simpanan}',[SimpananController::class,'update']);
Route::get('/simpanan/hapus/{id_simpanan}', [SimpananController::class,'destroy']);
Route::get('/simpanan/print/{id_anggota}', [SimpananController::class,'print']);

Route::get('/penarikan', [PenarikanController::class,'penarikan']);
Route::get('/penarikan/tarik/{id_anggota}', [PenarikanController::class,'tarik']);
Route::post('/penarikan/tarik',[PenarikanController::class,'pushTarik']);
Route::get('/penarikan/edit/{id_penarikan}',[PenarikanController::class,'edit']);
Route::post('/penarikan/update/{id_penarikan}',[PenarikanController::class,'update']);
Route::get('/penarikan/hapus/{id_penarikan}', [PenarikanController::class,'destroy']);
Route::get('/penarikan/print/{id_penarikan}', [PenarikanController::class,'print']);

Route::get('/akad/kredit', [AkadController::class,'kredit']);
Route::get('/akad/kredit/tambah/{id_kredit}', [AkadController::class,'addKredit']);
Route::post('/akad/kredit/tambah',[AkadController::class,'pushKredit']);
Route::get('/akad/kredit/edit/{id_kredit}', [AkadController::class,'editKredit']);
Route::post('/akad/kredit/update/{id_kredit}', [AkadController::class,'updateKredit']);
Route::get('/akad/kredit/hapus/{id_kredit}', [AkadController::class,'destroyKredit']);
Route::post('/upload/suratkredit/{id_kredit}', [AkadController::class,'suratKredit']);
Route::get('/suratkredit/{surat_kredit}', [AkadController::class,'getKredit']);
Route::get('/kredit/print/{id_kredit}', [AkadController::class,'printKredit']);

Route::get('/akad/qordh', [AkadController::class,'qordh']);
Route::get('/akad/qordh/tambah/{id_qordh}', [AkadController::class,'addQordh']);
Route::post('/akad/qordh/tambah',[AkadController::class,'pushQordh']);
Route::get('/akad/qordh/edit/{id_qordh}', [AkadController::class,'editQordh']);
Route::post('/akad/qordh/update/{id_qordh}', [AkadController::class,'updateQordh']);
Route::get('/akad/qordh/hapus/{id_qordh}', [AkadController::class,'destroyQordh']);
Route::post('/upload/suratqordh/{id_qordh}', [AkadController::class,'suratQordh']);
Route::get('/suratqordh/{surat_qordh}', [AkadController::class,'getQordh']);
Route::get('/qordh/print/{id_qordh}', [AkadController::class,'printQordh']);

Route::get('/akad/mudorobah', [AkadController::class,'mudorobah']);
Route::get('/akad/mudorobah/tambah/{id_mudorobah}', [AkadController::class,'addMudorobah']);
Route::post('/akad/mudorobah/tambah',[AkadController::class,'pushMudorobah']);
Route::get('/akad/mudorobah/edit/{id_mudorobah}', [AkadController::class,'editMudorobah']);
Route::post('/akad/mudorobah/update/{id_mudorobah}', [AkadController::class,'updateMudorobah']);
Route::get('/akad/mudorobah/hapus/{id_mudorobah}', [AkadController::class,'destroyMudorobah']);
Route::post('/upload/suratmudorobah/{id_mudorobah}', [AkadController::class,'suratMudorobah']);
Route::get('/suratmudorobah/{surat_mudorobah}', [AkadController::class,'getMudorobah']);
Route::get('/mudorobah/print/{id_mudorobah}', [AkadController::class,'printMudorobah']);

Route::get('/angsuran/kredit', [AngsuranController::class,'kredit']);
Route::get('/angsuran/kredit/tambah/{id_angsuran}', [AngsuranController::class,'addKredit']);
Route::post('/angsuran/kredit/tambah', [AngsuranController::class,'pushKredit']);
Route::get('/angsuran/kredit/edit/{id_angsuran}', [AngsuranController::class,'editKredit']);
Route::post('/angsuran/kredit/update/{id_angsuran}', [AngsuranController::class,'updateKredit']);
Route::get('/angsuran/kredit/hapus/{id_angsuran}', [AngsuranController::class,'destroyKredit']);
Route::get('/angsuran/kredit/print/{id_angsuran}', [AngsuranController::class,'printKredit']);

Route::get('/angsuran/qordh', [AngsuranController::class,'qordh']);
Route::get('/angsuran/qordh/tambah/{id_angsuran}', [AngsuranController::class,'addQordh']);
Route::post('/angsuran/qordh/tambah', [AngsuranController::class,'pushQordh']);
Route::get('/angsuran/qordh/edit/{id_angsuran}', [AngsuranController::class,'editQordh']);
Route::post('/angsuran/qordh/update/{id_angsuran}', [AngsuranController::class,'updateQordh']);
Route::get('/angsuran/qordh/hapus/{id_angsuran}', [AngsuranController::class,'destroyQordh']);
Route::get('/angsuran/qordh/print/{id_angsuran}', [AngsuranController::class,'printQordh']);

Route::get('/angsuran/mudorobah', [AngsuranController::class,'mudorobah']);
Route::get('/angsuran/mudorobah/tambah/{id_angsuran}', [AngsuranController::class,'addMudorobah']);
Route::post('/angsuran/mudorobah/tambah', [AngsuranController::class,'pushMudorobah']);
Route::get('/angsuran/mudorobah/edit/{id_angsuran}', [AngsuranController::class,'editMudorobah']);
Route::post('/angsuran/mudorobah/update/{id_angsuran}', [AngsuranController::class,'updateMudorobah']);
Route::get('/angsuran/mudorobah/hapus/{id_angsuran}', [AngsuranController::class,'destroyMudorobah']);
Route::get('/angsuran/mudorobah/print/{id_angsuran}', [AngsuranController::class,'printMudorobah']);

Route::get('/angsuran/mudorobah/keuntungan', [AngsuranController::class,'KeuntunganMudorobah']);
Route::get('/angsuran/mudorobah/keuntungan/tambah/{id_keuntungan}', [AngsuranController::class,'addKeuntunganMudorobah']);
Route::post('/angsuran/mudorobah/keuntungan/tambah', [AngsuranController::class,'pushKeuntunganMudorobah']);
Route::get('/angsuran/mudorobah/keuntungan/edit/{id_keuntungan}', [AngsuranController::class,'editKeuntunganMudorobah']);
Route::post('/angsuran/mudorobah/keuntungan/update/{id_keuntungan}', [AngsuranController::class,'updateKeuntunganMudorobah']);
Route::get('/angsuran/mudorobah/keuntungan/hapus/{id_keuntungan}', [AngsuranController::class,'destroyKeuntunganMudorobah']);
Route::get('/keuntungan/print/{id_keuntungan}', [AngsuranController::class,'printKeuntungan']);

Route::get('/pemasukan/tambah', [KoperasiController::class,'addPemasukan']);
Route::post('/pemasukan/tambah', [KoperasiController::class,'pushPemasukan']);
Route::get('/pemasukan/edit/{id_pemasukan}', [KoperasiController::class,'editPemasukan']);
Route::post('/pemasukan/update/{id_pemasukan}', [KoperasiController::class,'updatePemasukan']);
Route::get('/pemasukan/hapus/{id_pemasukan}', [KoperasiController::class,'destroyPemasukan']);

Route::get('/pengeluaran/tambah', [KoperasiController::class,'addPengeluaran']);
Route::post('/pengeluaran/tambah', [KoperasiController::class,'pushPengeluaran']);
Route::get('/pengeluaran/edit/{id_pengeluaran}', [KoperasiController::class,'editPengeluaran']);
Route::post('/pengeluaran/update/{id_pengeluaran}', [KoperasiController::class,'updatePengeluaran']);
Route::get('/pengeluaran/hapus/{id_pengeluaran}', [KoperasiController::class,'destroyPengeluaran']);

Route::get('/koperasi', [KoperasiController::class,'index']);
Route::post('/koperasi', [KoperasiController::class,'pushKoperasi']);
Route::get('/koperasi/edit/{id}', [KoperasiController::class,'editKoperasi']);
Route::post('/koperasi/update/{id}', [KoperasiController::class,'updateKoperasi']);

Route::get('/koperasi/pengurus', [KoperasiController::class,'pengurus']);
Route::get('/koperasi/pengurus/tambah', [KoperasiController::class,'addpengurus']);
Route::post('/koperasi/pengurus/tambah', [KoperasiController::class,'pushpengurus']);
Route::get('/koperasi/pengurus/edit/{id}', [KoperasiController::class,'editpengurus']);
Route::post('/koperasi/pengurus/update/{id}', [KoperasiController::class,'updatepengurus']);
Route::get('/koperasi/pengurus/hapus/{id}', [KoperasiController::class,'deletepengurus']);

Route::get('/mdata', [KoperasiController::class,'mdata']);
Route::post('/mdata/tambah', [KoperasiController::class,'addmdata']);
Route::get('/mdata/edit/{id}', [KoperasiController::class,'editmdata']);
Route::post('/mdata/update/{id}', [KoperasiController::class,'updatemdata']);

Route::get('/jsimpanan', [KoperasiController::class,'addjenis']);
Route::post('/jsimpanan/tambah', [KoperasiController::class,'pushjenis']);
Route::get('/jsimpanan/edit/{id}', [KoperasiController::class,'editjsimpanan']);
Route::post('/jsimpanan/update/{id}', [KoperasiController::class,'updatejsimpanan']);
Route::get('/jsimpanan/delete/{id_jenis}', [KoperasiController::class,'deletejsimpanan']);
