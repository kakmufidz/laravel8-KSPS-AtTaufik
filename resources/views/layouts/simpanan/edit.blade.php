@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Simpanan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Simpanan</a></li>
            <li class="breadcrumb-item active">Data Simpanan</li>
          </ol>
        </div><!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Setoran</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="/simpanan/update/{{$simpanan->id_simpanan}}" method="POST">
                            <!--card-body -->
                            @csrf
                            <div class="card-body col-sm-6">
                              <div class="form-group">
                                  <label for="id_simpanan">Nomor Transaksi</label>
                                  <input type="id" class="form-control col-sm-4" name="id_simpanan" value="STR{{$simpanan->id_simpanan}}" readonly>
                              </div>
                              <div class="form-group ">
                                  <label for="id_anggota">Nomor Anggota</label>
                                  <input type="id" class="form-control col-sm-4" name="id_anggota" value="{{$simpanan->anggota_id_anggota}}" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="name">Nama Lengkap</label>
                                  <input type="name" class="form-control" name="name" value="{{$simpanan->name}}" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="tglsetor">Tanggal</label>
                                  <input type="date" class="form-control col-sm-4" name="tglsetor" value="{{$simpanan->tgl}}">
                              </div>
                              <div class="form-group">
                                  <label for="tabungan">Tabungan</label>
                                  <input type="text" class="form-control" name="tabungan" value="{{$simpanan->tabungan}}">
                              </div>
                              <div class="form-group">
                                  <label for="s_wajib">Simpanan Wajib</label>
                                  <input type="text" class="form-control" name="s_wajib" value="{{$simpanan->s_wajib}}">
                              </div>
                              <div class="form-group">
                                  <label for="s-thr">Simpanan THR</label>
                                  <input type="text" class="form-control" name="s_thr" value="{{$simpanan->s_thr}}">
                              </div>
                              <div class="form-group">
                                  <label for="s_pendidikan">Simpanan Pendidikan</label>
                                  <input type="text" class="form-control" name="s_pendidikan" value="{{$simpanan->s_pendidikan}}">
                              </div>
                              @foreach ($jenis_simpanan as $jenis_simpanans)
                              <div id="{{$jenis_simpanans->kode_jenis}}" class="form-group">
                                  <label for="{{$jenis_simpanans->kode_jenis}}">{{$jenis_simpanans->kategori}}</label>
                                  <input type="text" class="form-control" name="{{$jenis_simpanans->kode_jenis}}" placeholder="0" value="0">
                              </div>
                              @endforeach
                              <div class="form-group">
                                  <label for="catatan">Catatan</label>
                                  <textarea class="form-control" name="catatan" rows="3">{{$simpanan->catatan}}</textarea>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group text-bold">
                                    <thead>
                                        <th>Total Setoran Rp. </th>
                                        <th>
                                        <input type="text" id="total" class="bg-light border-0 text-bold" value="0" readonly>
                                        </th>
                                    </thead>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                </div>
                <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
          <!-- /.content -->
          <!-- jQuery -->
    <!-- date-range-picker -->
</div>
  <!-- /.content-header -->
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $("#tabungan, #s_wajib, #s_thr, #s_pendidikan").keyup(function() {
            var tabungan  = $("#tabungan").val();
            var s_wajib = $("#s_wajib").val();
            var s_thr = $("#s_thr").val();
            var s_pendidikan = $("#s_pendidikan").val();

            var total = parseInt(tabungan) + parseInt(s_wajib)+parseInt(s_thr) + parseInt(s_pendidikan);
            $("#total").val(total);
        });
    });
</script>
@endsection