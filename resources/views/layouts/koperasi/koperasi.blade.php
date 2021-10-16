@extends('layouts.master')
@section('konten')
@if ($koperasi == null)
<div class="content-header">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Koperasi</h3>
                        </div>
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                            {{session('statusdg')}}
                        </div>
                        @endif
                        <form action="/koperasi" method="post">
                            @csrf
                            <!--card-body -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="nama_koperasi">Nama Koperasi</label>
                                    <input type="text" class="form-control" name="nama_koperasi" placeholder="Nama Koperasi" value="{{old('nama_koperasi')}}">
                                    @if ($errors->has('nama_koperasi'))
                                    <span class="text-danger">{{ $errors->first('nama_koperasi') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="no_kantor">Nomor Kantor</label>
                                    <input type="text" class="form-control" name="no_kantor" placeholder="Nomor Kantor" value="{{old('no_kantor')}}">
                                    @if ($errors->has('no_kantor'))
                                    <span class="text-danger">{{ $errors->first('no_kantor') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" rows="3" name="alamat" style="margin-top: 0px; margin-bottom: 0px; height: 131px;"></textarea>
                                    @if ($errors->has('alamat'))
                                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@else
<div class="card">
    <div class="card-body box-profile" >
        <a href="/koperasi/edit/{{$koperasi->id}}" class="btn btn-sm btn-default">
            <i href="/koperasi" class="fas fa-pencil-alt"></i>
        </a>
        <div class="text-center">
            <img class="profile-user-img img-circle" src="{{asset('')}}assets/dist/img/logokoperasi.png" alt="User profile picture">
        </div>
        <h3 class="profile-username text-center">{{$koperasi->nama_koperasi}}</h3>
        <p class="text-muted text-center">{{$koperasi->alamat}}, No. Telp: {{$koperasi->no_kantor}}</p>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
            <div class="inner">
                <h3>@currency($kasokoperasi)</h3>

                <p>Saldo Kas Koperasi</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
            <div class="inner">
                <h3>@currency($danaaman)</h3>

                <p>Dana Aman</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
            <div class="inner">
                <h3>@currency($danacadangan)</h3>

                <p>Dana Cadangan</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
            <div class="inner">
                <h3>@currency($totaldanasosial)</h3>

                <p>Dana Sosial</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
            <div class="inner">
                <h3>@currency($totalshupengurus)</h3>

                <p>SHU Pengurus</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
            <div class="inner">
                <h3>@currency($totalshuanggota)</h3>

                <p>SHU Anggota</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="card card-primary card-outline">
        <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#pemasukan" data-toggle="tab">Pemasukan</a></li>
            <li class="nav-item"><a class="nav-link" href="#pengeluaran" data-toggle="tab">Pengeluaran</a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="pemasukan">
                    <table class="table table-striped table-bordered">
                        @if (session('status'))
                        <div class="alert alert-success">
                        {{session('status')}}
                        </div>
                        @endif
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                        {{session('status')}}
                        </div>
                        @endif
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Masuk</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pemasukan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        @php $no=1; @endphp
                        @forelse ($pemasukan as $masuk)
                        <tbody>
                        <tr>
                            <td>{{$no++}}</td>
                            <td>MSK{{$masuk->id_pemasukan}}</td>
                            <td>{{$masuk->tgl}}</td>
                            <td>{{$masuk->pemasukan}}</td>
                            <td>@currency($masuk->jumlah)</td>
                            <td>{{$masuk->keterangan}}</td>
                            <td>
                            <div class="text-right">
                                <a href="/pemasukan/edit/{{$masuk->id_pemasukan}}" class="btn btn-sm btn-success">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-pemasukan" onclick="pass_id_pemasukan({{$masuk->id_pemasukan}})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </tr>
                        </tbody>
                        @empty
                        <div class="alert alert-danger">
                            Data belum tersedia !!!
                        </div>
                        @endforelse
                    </table>
                    <div class="d-flex justify-content-center">{{$pemasukan->links()}}</div>
                </div>
                <div class="tab-pane" id="pengeluaran">
                    <table class="table table-striped table-bordered">
                        @if (session('status'))
                        <div class="alert alert-success">
                        {{session('status')}}
                        </div>
                        @endif
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                        {{session('status')}}
                        </div>
                        @endif
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Keluar</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pengeluaran</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        @php $no=1; @endphp
                        @forelse ($pengeluaran as $keluar)
                        <tbody>
                        <tr>
                            <td>{{$no++}}</td>
                            <td>KLR{{$keluar->id_pengeluaran}}</td>
                            <td>{{$keluar->tgl}}</td>
                            <td>{{$keluar->pengeluaran}}</td>
                            <td>{{$keluar->jumlah}}</td>
                            <td>@currency($keluar->harga)</td>
                            <td>@currency($keluar->total_harga)</td>
                            <td>{{$keluar->keterangan}}</td>
                            <td>
                            <div class="text-right">
                                <a href="/pengeluaran/edit/{{$keluar->id_pengeluaran}}" class="btn btn-sm btn-success">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-pengeluaran" onclick="pass_id_pengeluaran({{$keluar->id_pengeluaran}})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </tr>
                        </tbody>
                        @empty
                        <div class="alert alert-danger">
                            Data belum tersedia !!!
                        </div>
                        @endforelse
                    </table>
                    <div class="d-flex justify-content-center">{{$pengeluaran->links()}}</div>
                </div>
            </div>
            <div class="modal fade" id="modal-hapus-pemasukan">
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
                            <a id="modal_delete_pemasukan" href="#" methode="post" class="btn btn-sm btn-danger">
                                Hapus
                            </a>
                        </div>
                    </div><!-- /.modal-content -->
                </div> <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-hapus-pengeluaran">
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
                            <a id="modal_delete_pengeluaran" href="#" methode="post" class="btn btn-sm btn-danger">
                                Hapus
                            </a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
        </div>
    </div>
</section>
@endif
@endsection
@section('script')
  <script type="text/javascript">
    function pass_id_pemasukan(id) {
      var delete_button = document.getElementById("modal_delete_pemasukan");
      delete_button.href = "/pemasukan/hapus/"+id;
    }
    function pass_id_pengeluaran(id) {
      var delete_button = document.getElementById("modal_delete_pengeluaran");
      delete_button.href = "/pengeluaran/hapus/"+id;
    }
  </script>
@endsection