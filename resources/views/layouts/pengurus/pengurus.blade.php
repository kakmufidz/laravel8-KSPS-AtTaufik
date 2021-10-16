@extends('layouts.master')
@section('konten')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Pengurus</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Pengurus</li>
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
                  <h3 class="card-title">Daftar Pengurus</h3>
                </div>
                <!-- /.card-header -->
                <div class="col-lg-4">
                  <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="far fa-plus-square"></i></span>
                    <div class="info-box-content">
                      <a href="/koperasi/pengurus/tambah" class="btn btn-primary btn-block">Tambah Pengurus</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Lahir</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">HP</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    @forelse ($pengurus as $data)
                    <tbody>
                      <tr>
                        <td>{{$data->jabatan}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->tmlahir}}, {{$data->tglahir}}</td>
                        <td>{{$data->alamat}}</td>
                        <td>{{$data->hp}}</td>
                        <td>
                          <div class="text-right">
                            <a href="/koperasi/pengurus/edit/{{$data->id}}" class="btn btn-sm btn-success">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-sm" onclick="pass_id_to_modal({{$data->id}})">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                    @empty
                      <div class="alert alert-danger text-center">
                          Data Pengurus belum tersedia
                      </div>
                    @endforelse
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="modal fade" id="modal-sm">
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
                <div class="d-flex justify-content-center">{{$pengurus->links()}}</div>
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
      delete_button.href = "/koperasi/pengurus/hapus/" + id;
    }
  </script>
@endsection