@extends('layouts.master')
@section('konten')
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KSPS At Taufiq Mutra Ummat | Hutang</title>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <!-- Main content -->
    @foreach ($qordh as $qordhs)
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
              <h1>SURAT PERJANJIAN HUTANG</h1>
            </div>
            <div class="row col-12">
              <h5 class="text-justify">
                <p style="text-indent: 50px; line-height:2em;">
                  Yang bertanda tangan di bawah ini pihak-pihak yang melakukan akad dari koperasi At Taufiq Mitra Ummat menyatakan sepakat untuk mengadakan akad hutang dengan ketentuan sebagai berikut :
                </p>
              </h5>
            </div>
            <div class="col-12">
              <table class="table">
                <tr>
                  <th class="w-25">ID Transaksi</td>
                  <td class="w-75">: H100{{$qordhs->id_qordh}}</td>
                </tr>
                <tr>
                  <th class="w-25">Nama Pemohon</td>
                  <td class="w-75">: {{$qordhs->id_anggota}} - {{$qordhs->name}}</td>
                </tr>
                <tr>
                  <th class="w-25">Tempat Tanggal Lahir</td>
                  <td class="w-75">: {{$qordhs->tmlahir}}, {{$qordhs->tglahir}}</td>
                </tr>
                <tr>
                  <th class="w-25">Alamat</td>
                  <td class="w-75">: {{$qordhs->alamat}}</td>
                </tr>
                <tr>
                  <th class="w-25">No Handphone</td>
                  <td class="w-75">: {{$qordhs->hp}}</td>
                </tr>
                <tr>
                  <th class="w-25">Jumlah Hutang</td>
                  <td class="w-75">: @currency($qordhs->jumlah)</td>
                </tr>
                <tr>
                  <th class="w-25">Jatuh Tempo</td>
                  <td class="w-75">: {{$qordhs->jatuh_tempo}}</td>
                </tr>
                <tr>
                  <th class="w-25">Keterangan</td>
                  <td class="w-75">: {{$qordhs->keterangan}}</td>
                </tr>
              </table>
            </div>
            <div class="row col-12">
              <h5 class="text-justify">
                <p style="text-indent: 50px; line-height:2em;">
                  Dalam hal ini pemohon bersedia melunasi hutangnya sampai batas akhir jatuh tempo, apabila dalam masa pelunasan mengalami kendala sehingga belum bisa melunasi hutang maka akan diselesaikan dengan cara musyawarah.<br>
                  Demikian surat perjanjian ini kami buat dengan sebenarnya, tanpa ada paksaan /tekanan dari pihak manapun.<br>
                </p>
              </h5>
            </div>
            <div class="row">
              <div class="col-12" style="padding-left: 600px">
                <h5>Purwokerto, {{$qordhs->tgl}}</h5><br><br>
              </div>
            </div>
            <div class="row">
              <div class="col-4 align-self-center text-center">
                <h5>
                  <b>
                    PEMOHON
                      <br>
                      <br>
                      <br>
                      <br>
                    <u>({{$qordhs->name}})</u>
                  </b>
                </h5>
              </div>
              <div class="col-4 align-self-center text-center">
                <h5>
                  <b>
                    BENDAHARA
                      <br>
                      <br>
                      <br>
                      <br>
                      @if (empty(\App\Models\Pengurus::where('jabatan', 'Bendahara')->value('name')))
                        <u>(...............................)</u>
                      @else
                        <u>({{\App\Models\Pengurus::where('jabatan', 'Bendahara')->value('name')}})</u>
                      @endif
                  </b>
                </h5>
              </div>
              <div class="col-4 align-self-center text-center">
                <h5>
                  <b>
                    KETUA PENGURUS
                      <br>
                      <br>
                      <br>
                      <br>
                      @if (empty(\App\Models\Pengurus::where('jabatan', 'Ketua Umum')->value('name')))
                        <u>(...............................)</u>
                      @else
                        <u>({{\App\Models\Pengurus::where('jabatan', 'Ketua Umum')->value('name')}})</u>
                      @endif
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