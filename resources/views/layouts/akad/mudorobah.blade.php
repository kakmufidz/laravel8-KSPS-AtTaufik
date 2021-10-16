@extends('layouts.master')
@section('konten')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Mudorobah</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Mudorobah</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>@currency($totalMudorobah-$totalangsuran)</h3>

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
                    @forelse ($mudorobah as $data)
                    <div class="row">
                      <div class="col-md-4">
                        <div class="card card-widget widget-user-2">
                          <div class="pl-2 pt-2 bg-warning">
                            <div class="row">
                              <div class="col-md-9">
                                <h5>{{$data->jenis_usaha}}</h5>
                                <h6>M100{{$data->id_mudorobah}} | {{$data->tgl}}</h6>
                                <h6>{{$data->no_anggota}} - {{$data->name}}</h6>
                              </div>
                              <div class="col-md-3">
                                @if ($data->sisa_hutang == 0)
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
                                  Bagi Hasil <span class="float-right text-bold">{{$data->bagi_hasil}}%</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Berakhir <span class="float-right text-bold">{{$data->berakhir}}</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Sisa Hutang <span class="float-right text-bold">Rp @currency($data->sisa_hutang)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Penanggungjawab <span class="float-right text-bold">{{$data->penanggungjawab}}</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Saksi <span class="float-right text-bold">{{$data->saksi}}</span>
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
                                  <a href="/akad/mudorobah/edit/{{$data->id_mudorobah}}" class="btn btn-sm btn-success">
                                     <i class="fas fa-pencil-alt"></i>
                                  </a>
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus" onclick="pass_id_to_modal({{ $data->id_mudorobah}})">
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
                  </div>
                </div>
              </div>
            </div>
        </div>
      </section>
@endsection
@section('script')
<script type="text/javascript">
    function pass_id_to_modal(id) {
      var delete_button = document.getElementById("modal_delete_link");
      delete_button.href = "/akad/mudorobah/hapus/" + id;
    }
</script>
@endsection