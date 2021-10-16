@extends('layouts.master')
@section('konten')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">History Penarikan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Penarikan</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">History Penarikan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">No Anggota</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Catatan</th>
                        {{-- <th scope="col">Aksi</th> --}}
                      </tr>
                    </thead>
                    @php $no=1; @endphp
                    @forelse ($penarikan as $data)
                    <tbody>
                      <tr>
                        <td>{{$no++}}</td>
                        <td>P100{{$data->id_penarikan}}</td>
                        <td>{{$data->id_anggota}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->tgl}}</td>
                        <td>@currency($data->jumlah)</td>
                        <td>{{$data->catatan}}</td>
                        {{-- <td>
                          <div class="text-right">
                            <a href="/penarikan/edit/{{$data->id_penarikan}}" class="btn btn-sm btn-success">
                               Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus" onclick="pass_id_to_modal({{$data->id_penarikan}})">
                               Hapus
                            </button>
                          </div>
                        </td> --}}
                      </tr>
                    </tbody>
                    @empty
                      <div class="alert alert-danger text-center">
                      Data Penarikan belum tersedia.
                      </div>   
                    @endforelse
                  </table>
                </div>
                <!-- /.card-body -->
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
                <!-- /.modal -->
                <div class="d-flex justify-content-center">{{$penarikan->links()}}</div>
              </div>
              <!-- /.card -->
            <!-- /.col -->
            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
@section('script')
  <script type="text/javascript">
    function pass_id_to_modal(id) {
      var delete_button = document.getElementById("modal_delete_link");
      delete_button.href = "/penarikan/hapus/" + id;
    }
  </script>
@endsection