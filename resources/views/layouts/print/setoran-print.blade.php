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
              <h2>BUKTI TRANSAKSI SETORAN
                <h5>NO: S100{{$joinAnggota->id_simpanan}}</h5>
              </h2>
            </div>
            <div class="col-12">
              <table class="table">
                <tr>
                  <th class="w-25">Nama Anggota</td>
                  <td class="w-75">: {{$joinAnggota->id_anggota}} - {{$joinAnggota->name}}</td>
                </tr>
                <tr>
                  <th class="w-25">Tanggal Transaksi</td>
                  <td class="w-75">: {{$joinAnggota->tgl}}</td>
                </tr>
              </table>
            </div>
            <div class="col-12">
              <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Jumlah Simpanan</th>
                    <th scope="col">Jenis Simpanan</th>
                    <th scope="col">Catatan</th>
                  </tr>
                </thead>
                @php $no=1; @endphp
                @forelse ($datasimpanan as $datasimpanans)
                <tbody>
                  <tr>
                    <td>{{$no++}}</td>
                    <td>@currency($datasimpanans->jumlah_simpanan)</td>
                    <td>{{$datasimpanans->kategori}}</td>
                    <td>{{$datasimpanans->keterangan}}</td>
                  </tr>
                </tbody>
                @empty
                  <div class="alert alert-danger text-center">
                      Data Simpanan belum tersedia
                  </div>
                @endforelse
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
@section('script')
<script>
  window.addEventListener("load", window.print());
</script>
@endsection