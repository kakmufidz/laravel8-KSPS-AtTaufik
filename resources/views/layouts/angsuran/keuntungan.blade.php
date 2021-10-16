@extends('layouts.master')
@section('konten')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Keuntungan Mudorobah</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Mudorobah</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Keuntungan Mudorobah</h3>
              </div>
              <!-- /.card-header -->
              @if (session('status'))
              <div class="alert alert-success">
                {{session('status')}}
              </div>
              @endif
              @if (session('statusdg'))
              <div class="alert alert-danger">
                {{session('statusdg')}}
              </div>
              @endif
              <div class="card-body">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 20px">No.</th>
                      <th>ID Keuntungan</th>
                      <th>Nama Anggota</th>
                      <th>Tanggal</th>
                      <th>Data Mudorobah</th>
                      <th>Laba Usaha</th>
                      <th>Jumlah</th>
                      <th>Pembagian</th>
                      <th>Keterangan</th>
                      {{-- <th>Aksi</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @forelse ($keuntungan as $datas)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>U100{{$datas->id_keuntungan}}</td>
                      <td>{{$datas->no_anggota}} - {{$datas->name}}</td>
                      <td>{{$datas->tgl}}</td>
                      <td>{{$datas->id_mudorobah}}  |{{$datas->data_mudorobah}}</td>
                      <td>@currency($datas->laba_usaha)</td>
                      <td>@currency($datas->jumlah)</td>
                      <td>
                        Dana Cadangan {{$datas->prosentase_danacadangan}}% = @currency($datas->masuk_danacadangan)<br>
                        Dana Sosial {{$datas->prosentase_danasosial}}% = @currency($datas->masuk_danasosial)<br>
                        SHU Pengurus {{$datas->prosentase_shupengurus}}% = @currency($datas->masuk_shupengurus)<br>
                        SHU Anggota {{$datas->prosentase_shuanggota}}% = @currency($datas->masuk_shuanggota)<br>
                      </td>
                      <td>{{$datas->keterangan}}</td>
                      {{-- <td>
                        <div class="text-right">
                          <a href="/angsuran/mudorobah/keuntungan/edit/{{$datas->id_keuntungan}}" class="btn btn-sm btn-success">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus" onclick="pass_id_to_modal({{$datas->id_keuntungan}})">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </div>
                      </td> --}}
                    </tr>                         
                    @empty
                        <div class="alert alert-danger text-center col-md-4">
                          Data belum tersedia.
                        </div>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="d-flex justify-content-center">{{$keuntungan->links()}}</div>
              </div>
            </div>
            <div class="modal fade" id="modal-hapus">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Yakin hapus data?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Data yang dihapus tidak dapat kembali&hellip;</p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a id="modal_delete_link" href="#" methode="post" class="btn btn-sm btn-danger">
                       Hapus
                    </a>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
          <!-- /.col -->
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  <!-- /. Daftar Angsuran content -->
@endsection
@section('script')
    <script type="text/javascript">
      function pass_id_to_modal(id) {
        var delete_button = document.getElementById("modal_delete_link");
        delete_button.href = "/angsuran/mudorobah/keuntungan/hapus/" + id;
      }
    </script>
@endsection