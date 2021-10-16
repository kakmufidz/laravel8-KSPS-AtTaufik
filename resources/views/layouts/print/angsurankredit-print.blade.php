@extends('layouts.master')
@section('konten')
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KSPS At Taufiq Mutra Ummat</title>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <!-- Main content -->
    @foreach ($angsurankredit as $angsurankredits)
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12" style="padding-left:30mm;padding-right:30mm;">
          <h2 class="page-header">
            <div class="row">
              <div class="col-2">
                <img src="{{asset('')}}assets/dist/img/logokoperasinama.jpeg" 
                     style="object-fit:cover; width:100px; height:100px;"
                     alt="Logo Koperasi">
              </div>
              <div class="col-10 align-self-center text-center">
                <h2>KSPPS AT TAUFIQ MITRA UMMAT
                  <h5>Jl. Arsameja, Desa Kotayasa RT07/RW05, 
                    Kecamatan Sumbang, Kabupaten Banyumas – 
                    Jawa Tengah (53183) Telp. 083128374874
                  </h5>
                </h2>
              </div>
            </div>
          </h2>
          <hr width="100%" style="border:3" size="3" noshade="true">
          <div class="col-12">
            <div class="text-center ">
              <h2>BUKTI SETORAN ANGSURAN KREDIT
                <h5>NO: A100{{$angsurankredits->id_angsuran_kredit}}</h5>
              </h2>
            </div>
            <div class="col-12">
              <table class="table">
                <tr>
                  <th class="w-25">Nama Anggota</td>
                  <td class="w-75">: {{$angsurankredits->id_anggota}} - {{$angsurankredits->name}}</td>
                </tr>
                <tr>
                  <th class="w-25">Tanggal Transaksi</td>
                  <td class="w-75">: {{$angsurankredits->tgl}}</td>
                </tr>
              </table>
            </div>
            @php $no=1; @endphp
            @forelse ($angsurankredit as $angsurankredits)
            <div class="col-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col" style="width: 10px">No.</th>
                    <th scope="col">Data Kredit</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$angsurankredits->data_kredit}}</td>
                    <td>@currency($angsurankredits->jumlah_angsuran)</td>
                    <td>{{$angsurankredits->keterangan}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-12" style="padding-left: 20px">
                <h5>Sisa Kredit = 
                  @if ($angsurankredits->sisa_kredit == 0)
                      <b>Lunas</b>
                  @else
                      <b>Rp @currency($angsurankredits->sisa_kredit)</b></h5><br><br>
                  @endif
              </div>
            @empty
              <div class="alert alert-danger">
                Data belum tersedia !!!
              </div>
            @endforelse
            </div>
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