@extends('layouts.master')
@section('konten')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Hutang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Hutang</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>@currency($totalqordh-$totalangsuran)</h3>

                  <p>Sisa Piutang</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Daftar Hutang</h3>
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
                  @forelse ($qordh as $data)
                    <div class="row">
                      <div class="col-md-4">
                        <div class="card card-widget widget-user-2">
                          <div class="pl-4 bg-success">
                            <div class="row">
                              <div class="col-md-9  pt-4">
                                <h5 class="text-bold">{{$data->no_anggota}} - {{$data->name}}</h5>
                                <h6>H100{{$data->id_qordh}} | {{$data->tgl}}</h6>
                              </div>
                              <div class="col-md-3 pt-2">
                                @if ($data->sisa_qordh == 0)
                                <div class="pr-4">
                                  <img class="profile-user-img img-fluid img-circle"
                                  src="{{asset('')}}assets/dist/img/success-icon.png">
                                </div>
                                <label>Lunas</label>
                                @else
                                <div class="pr-4">
                                  <img class="profile-user-img img-fluid img-circle"
                                  src="{{asset('')}}assets/dist/img/wrong-icon.png">
                                </div>
                                <label>Belum Lunas</label>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="card-footer p-0">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Jumlah <span class="float-right text-bold">Rp @currency($data->jumlah)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Sisa Hutang <span class="float-right text-bold">Rp @currency($data->sisa_qordh)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Lama Angsuran <span class="float-right text-bold">{{$data->lama_angsuran}}</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Jatuh Tempo <span class="float-right text-bold">{{$data->jatuh_tempo}}</span>
                                </h6>
                              </li>
                              <li class="nav-item col-md-12">
                                <h6 class="pl-2 nav-link text-bold">
                                  Keterangan
                                </h6>
                                <p class="pl-2">{{$data->keterangan}}</p>
                              </li>
                              {{-- <div class="card-footer">
                                <div class="text-right">
                                  <a href="/akad/qordh/edit/{{$data->id_qordh}}" class="btn btn-sm btn-success">
                                     <i class="fas fa-pencil-alt"></i>
                                  </a>
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus" onclick="pass_id_to_modal({{ $data->id_qordh}})">
                                    <i class="fas fa-trash-alt"></i>
                                  </button>
                                </div>
                              </div> --}}
                            </ul>
                          </div>
                        </div>
                        <!-- /.widget-user -->
                      </div>
                    </div>
                    @empty
                        <div class="alert alert-danger text-center col-md-4">
                          Data masih kosong
                        </div>
                    @endforelse
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
      delete_button.href = "/akad/qordh/hapus/" + id;
    }
</script>
@endsection