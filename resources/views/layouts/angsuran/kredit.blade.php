@extends('layouts.master')
@section('konten')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Angsuran Kredit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Angsuran</li>
                <li class="breadcrumb-item active">Kredit</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      
  <!-- Main content -->
   <!-- History Angsuran content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">History Angsuran Kredit</h3>
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
                      <th>ID Angsuran</th>
                      <th>Nama Anggota</th>
                      <th>Tanggal</th>
                      <th>Data Kredit</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                      {{-- <th>Aksi</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @forelse ($angsuran as $datas)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>A100{{$datas->id_angsuran_kredit}}</td>
                      <td>{{$datas->no_anggota}} - {{$datas->name}}</td>
                      <td>{{$datas->tgl}}</td>
                      <td>{{$datas->data_kredit}}</td>
                      <td><b>@currency($datas->jumlah)</b></td>
                      <td>{{$datas->keterangan}}</td>
                      {{-- <td>
                        <div class="text-right">
                          <a href="/angsuran/kredit/edit/{{$datas->id_angsuran_kredit}}" class="btn btn-sm btn-success">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus" onclick="pass_id_to_modal({{$datas->id_angsuran_kredit}})">
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
                <div class="d-flex justify-content-center">{{$angsuran->links()}}</div>
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
        delete_button.href = "/angsuran/kredit/hapus/" + id;
      }
    </script>
@endsection