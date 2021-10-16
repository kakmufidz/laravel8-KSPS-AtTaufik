@extends('layouts.master-print')
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
          <div class="col-12" style="visibility: hidden">
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
          </div>
          <div class="col-12">
            <div class="col-12 text-center">
              <table class="table">
                <tbody>
                  <tr>
                    <td>{{date("d-m-Y", strtotime($today))}}</td>
                    <td>0</td>
                    <td>@currency($totalWajib)</td>
                    <td>0</td>
                    <td>@currency($totalTHR)</td>
                    <td>0</td>
                    <td>@currency($totalPendidikan)</td>
                    <td>0</td>
                    <td>@currency($totalTabungan)</td>
                    <td>0</td>
                    <td>saldo</td>
                  </tr>
                </tbody>
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