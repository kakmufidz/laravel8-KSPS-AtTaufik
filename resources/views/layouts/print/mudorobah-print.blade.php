@extends('layouts.master')
@section('konten')
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KSPS At Taufiq Mutra Ummat | Mudorobah</title>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <!-- Main content -->
    @foreach ($mudorobah as $mudorobahs)
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12" style="padding-left:30mm;padding-right:30mm;">
          <h2 class="page-header">
            <div class="row">
              <div class="col-2">
                <img src="{{asset('')}}assets/dist/img/logokoperasinama.jpeg" 
                     style="object-fit:cover; width:140px; height:140px;"
                     alt="Logo Koperasi">
              </div>
              <div class="col-10 align-self-center text-center">
                <h1>KSPPS AT TAUFIQ MITRA UMMAT
                  <h5>Jl. Arsameja, Desa Kotayasa RT07/RW05, 
                    Kecamatan Sumbang, Kabupaten Banyumas – 
                    Jawa Tengah (53183) Telp. 083128374874
                  </h5>
                </h1>
              </div>
            </div>
          </h2>
          <hr width="100%" style="border:3" size="3" noshade="true">
          <div class="col-12">
            <div class="text-center ">
              <h1>SURAT PERJANJIAN MUDOROBAH</h1>
            </div>
            <div class="row col-12">
              <h5 class="text-justify">
                <p style="text-indent: 50px; line-height:2em;">
                  Yang bertanda tangan di bawah ini pihak-pihak yang melakukan akad mudorobah/kerjasama dengan koperasi At Taufiq Mitra Ummat menyatakan sepakat untuk mengadakan kerjasama dengan ketentuan sebagai berikut: <br>
                </p>
              </h5>
            </div>
            <div class="col-12">
              <table class="table">
                <tr>
                  <th class="w-25">Nama</td>
                  <td class="w-75">: {{$mudorobahs->penanggungjawab}}</td>
                </tr>
                <tr>
                  <th class="w-25">Alamat</td>
                  <td class="w-75">: {{\App\Models\Pengurus::where('name', $mudorobahs->penanggungjawab)->value('alamat')}}</td>
                </tr>
                <tr>
                  <th class="w-25">No Handphone</td>
                  <td class="w-75">: {{\App\Models\Pengurus::where('name', $mudorobahs->penanggungjawab)->value('hp')}}</td>
                </tr>
                <th class="w-25">Jabatan</td>
                <td class="w-75">: {{\App\Models\Pengurus::where('name', $mudorobahs->penanggungjawab)->value('jabatan')}}</td>
              </tr>
              </table>
            </div>
            <div class="row col-12">
              <h5 class="text-justify">
                <p style="text-indent: 50px; line-height:2em;">
                  Selanjutnya disebut sebagai PIHAK I (Pemilik Modal) memberikan sejumlah uang sebagai modal usaha kepada:<br>
                </p>
              </h5>
            </div>
            <div class="col-12">
              <table class="table">
                <tr>
                  <th class="w-25">Nama</td>
                  <td class="w-75">: {{$mudorobahs->id_anggota}} - {{$mudorobahs->name}}</td>
                </tr>
                <tr>
                  <th class="w-25">Alamat</td>
                  <td class="w-75">: {{$mudorobahs->alamat}}</td>
                </tr>
                <tr>
                  <th class="w-25">No Handphone</td>
                  <td class="w-75">: {{$mudorobahs->hp}}</td>
                </tr>
                <tr>
                  <th class="w-25">Jabatan</td>
                  <td class="w-75">: Anggota</td>
                </tr>
              </table>
            </div>
            <div class="row col-12">
              <h5 class="text-justify">
                <p style="text-indent: 50px; line-height:2em;">
                  Selanjutnya disebut sebagai PIHAK II (Pelaku Usaha)<br>
                </p>
              </h5>
            </div>
            <div class="row col-12">
              <h5 class="text-justify">
                <p style=" line-height:2em;">
                  Pihak I memberikan modal berupa Uang kepada pihak II sebesar <b>Rp @currency($mudorobahs->jumlah)</b>, terbilang <b>{{terbilang($mudorobahs->jumlah)}} Rupiah</b>
                  yang akan digunakan sebagai modal usaha <b>{{$mudorobahs->jenis_usaha}}</b>,
                  dengan sistem bagi hasil sebesar <b>{{$mudorobahs->bagi_hasil}}%</b>.<br></p>
                <p style="text-indent: 50px; line-height:2em;">
                  Surat ini berlaku sejak ditandatangani oleh pihak-pihak terkait sampai dengan <b>{{$mudorobahs->berakhir}}</b>.<br>
                  Demikian surat perjanjian ini kami buat dengan sebenarnya, tanpa ada paksaan /tekanan dari pihak manapun.<br>
                </p>
              </h5>
            </div>
            <div class="row">
              <div class="col-12" style="padding-left: 600px">
                <h5>Purwokerto, {{$mudorobahs->tgl}}</h5><br><br>
              </div>
            </div>
            <div class="row">
              <div class="col-4 align-self-center text-center">
                <h5>
                  <b>
                    PIHAK I
                      <br>
                      <br>
                      <br>
                      <br>
                    <u>({{$mudorobahs->penanggungjawab}})</u>
                  </b>
                </h5>
              </div>
              <div class="col-4 align-self-center text-center">
                <h5>
                  <b>
                    SAKSI
                      <br>
                      <br>
                      <br>
                      <br>
                    <u>({{$mudorobahs->saksi}})</u>
                  </b>
                </h5>
              </div>
              <div class="col-4 align-self-center text-center">
                <h5>
                  <b>
                    PIHAK II
                      <br>
                      <br>
                      <br>
                      <br>
                    <u>({{$mudorobahs->name}})</u>
                  </b>
                </h5>
              </div>
            </div><br><br>
          </div>
        </div>
      </div>
    </section>
    @endforeach
  </div>
</div>
@endsection
@section('script')
<script>
  window.addEventListener("load", window.print());
</script>
@endsection