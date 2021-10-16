@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">Profile Anggota</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="/anggota">Anggota</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
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
      <div class="row">
        <div class="col-md-4">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                      src="{{asset('')}}uploads/avatars/{{$detail->image}}" 
                      style="object-fit:cover; width:150px; height:150px;"
                      alt="User profile picture">
              </div>
              <h3 class="profile-username text-center">{{$detail->name}}</h3>
              <p class="text-muted text-center"><strong>No: {{$detail->id_anggota}}</strong></p>          
              <div class="card-body">
                <strong><i class="fas fa-map-marker-alt mr-1"></i>Alamat</strong>
                <p class="text-muted">{{$detail->alamat}}</p>
                <strong><i class="fas fa-book mr-1"></i>Tempat Tanggal Lahir</strong>
                <p class="text-muted">{{$detail->tmlahir}}, {{$detail->tglahir}}</p>
                <strong><i class="fas fa-map-marker-alt mr-1"></i>No. KTP</strong>
                <p class="text-muted">{{$detail->ktp}}</p>
                <strong><i class="fas fa-pencil-alt mr-1"></i>Pendidikan</strong>
                <p class="text-muted">{{$detail->pendidikan}}</p>
                <strong><i class="fas fa-pencil-alt mr-1"></i>Pekerjaan</strong>
                <p class="text-muted">{{$detail->pekerjaan}}</p>
                <strong><i class="far fa-file-alt mr-1"></i>No. Telp/HP</strong>
                <p class="text-muted">{{$detail->hp}}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-8">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-6 col-6">
                <div class="info-box shadow">
                  <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <a href="/simpanan/tambah/{{$detail->id_anggota}}" class="btn btn-primary btn-block">Tambah Setoran</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6">
                <div class="info-box shadow">
                  <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <a href="/penarikan/tarik/{{$detail->id_anggota}}" class="btn btn-secondary btn-block">Penarikan</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6">
                <div class="info-box shadow">
                  <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <div class="btn-group">
                      <button type="button" class="btn btn-success">Tambah Angsuran</button>
                      <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      </button>
                      <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" href="/angsuran/kredit/tambah/{{$detail->id_anggota}}">Angsuran Kredit</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/angsuran/qordh/tambah/{{$detail->id_anggota}}">Angsuran Hutang</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/angsuran/mudorobah/tambah/{{$detail->id_anggota}}">Angsuran Mudorobah</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/angsuran/mudorobah/keuntungan/tambah/{{$detail->id_anggota}}">Keuntungan Mudorobah</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6">
                <div class="info-box shadow">
                  <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Tambah Akad</button>
                      <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      </button>
                      <div class="dropdown-menu bg-danger-dark" role="menu" style="">
                        <a class="dropdown-item" href="/akad/kredit/tambah/{{$detail->id_anggota}}">Kredit</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/akad/qordh/tambah/{{$detail->id_anggota}}">Hutang</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/akad/mudorobah/tambah/{{$detail->id_anggota}}">Mudorobah</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6"><!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                      <h3>@currency($totalTabungan-$PenarikanTabungan)</h3>
                      
                      <p>Saldo Tabungan</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person"></i>
                    </div>
                    <a href="#setoran" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-6"><!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>@currency($sisaKredit+$sisaQordh)</h3>
                    <p>Sisa Hutang + Kredit</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#setoran" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-6"><!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>@currency($totalWajib+$totalPokok)</h3>
                    <p>Pokok Wajib</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#setoran" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-6"><!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>@currency($sisaMudorobah)</h3>
                    <p>Sisa Hutang Mudorobah</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#setoran" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-6"><!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>@currency($totalPendidikan-$PenarikanPendidikan)</h3>
                    <p>Pendidikan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#setoran" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-6"><!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>@currency($totalTHR-$PenarikanTHR)</h3>
                    <p>THR</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#setoran" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
            <!-- /.row -->
        </div>
      </div>
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card">
            <div class="card-header p-2">
              <div class="row">
                <div class="col-md-10">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#setoran" data-toggle="tab">Setoran</a></li>
                    <li class="nav-item"><a class="nav-link" href="#penarikan" data-toggle="tab">Penarikan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kredit" data-toggle="tab">Kredit</a></li>
                    <li class="nav-item"><a class="nav-link" href="#qordh" data-toggle="tab">Hutang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#mudorobah" data-toggle="tab">Mudorobah</a></li>
                    <li class="nav-item"><a class="nav-link" href="#angsuran" data-toggle="tab">Angsuran</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#tabungan" data-toggle="tab">Cetak Tabungan</a></li> --}}
                  </ul>
                </div>
                <div class="col-md-2 float-right">
                  <a href="/tabungan/print/debit/{{$detail->id_anggota}}" rel="noopener" target="_blank" style="padding: 10px"  class="btn btn-sm btn-dark float-right">
                    <i class="fas fa-print"></i> Cetak Tabungan
                  </a>
                </div>
                {{-- <div class="col-md-2">
                  <a href="/tabungan/print/kredit/{{$detail->id_anggota}}" rel="noopener" target="_blank" style="padding: 10px"  class="btn btn-sm btn-dark float-right">
                    <i class="fas fa-print"></i> Kredit Terakhir
                  </a>
                </div> --}}
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                {{-- <div class="active tab-pane" id="setoran">
                  <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tabungan</th>
                        <th scope="col">S. Wajib</th>
                        <th scope="col">S. THR</th>
                        <th scope="col">S. Pendidikan</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    @php $no=1; @endphp
                    @forelse ($simpanan as $simpanans)
                    <tbody>
                      <tr>
                        <td>{{$no++}}</td>
                        <td>S100{{$simpanans->id_simpanan}}</td>
                        <td>{{$simpanans->tgl}}</td>
                        <td>{{$simpanans->id_anggota}} | {{$simpanans->name}}</td>
                        <td>@currency($simpanans->tabungan)</td>
                        <td>@currency($simpanans->s_wajib)</td>
                        <td>@currency($simpanans->s_thr)</td>
                        <td>@currency($simpanans->s_pendidikan)</td>
                        <td>{{$simpanans->catatan}}</td>
                        <td>
                          <div class="text-right">
                            <a href="/simpanan/print/{{$simpanans->id_simpanan}}" rel="noopener" target="_blank"  class="btn btn-sm btn-dark">
                              <i class="fas fa-print"></i>
                            </a>
                            <a href="/anggota/profile/editsimpanan/{{$simpanans->id_simpanan}}" class="btn btn-sm btn-success">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-simpanan" onclick="pass_id_simpanan({{$simpanans->id_simpanan}})">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                    @empty
                      <div class="alert alert-danger text-center">
                          Data Simpanan belum tersedia
                      </div>
                    @endforelse
                  </table>
                  <div class="modal fade" id="modal-hapus-simpanan">
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
                          <a id="modal_delete_simpanan" href="#" methode="post" class="btn btn-sm btn-danger">
                             Hapus
                          </a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </div> --}}
                <div class="active tab-pane" id="setoran">
                  <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah Simpanan</th>
                        <th scope="col">Jenis Simpanan</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    @php $no=1; @endphp
                    @forelse ($datasimpanan as $datasimpanans)
                    <tbody>
                      <tr>
                        <td>{{$no++}}</td>
                        <td>S100{{$datasimpanans->id_simpanan}}</td>
                        <td>{{$datasimpanans->tgl}}</td>
                        <td>{{$datasimpanans->id_anggota}} | 
                          {{\App\Models\Anggota::where('id_anggota', $datasimpanans->id_anggota)->value('name')}}
                        </td>
                        <td>@currency($datasimpanans->jumlah_simpanan)</td>
                        <td>{{$datasimpanans->kategori}}</td>
                        <td>{{$datasimpanans->keterangan}}</td>
                        <td>
                          <div class="text-right">
                            <a href="/simpanan/print/{{$datasimpanans->id_simpanan}}" rel="noopener" target="_blank"  class="btn btn-sm btn-dark">
                              <i class="fas fa-print"></i>
                            </a>
                            <a href="/anggota/profile/editsimpanan/{{$datasimpanans->id_jumlah}}" class="btn btn-sm btn-success">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-simpananlain" onclick="pass_id_simpananlain({{$datasimpanans->id_jumlah}})">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                    @empty
                      <div class="alert alert-danger text-center">
                          Data Simpanan belum tersedia
                      </div>
                    @endforelse
                  </table>
                  <div class="modal fade" id="modal-hapus-simpananlain">
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
                          <a id="modal_delete_simpananlain" href="#" methode="post" class="btn btn-sm btn-danger">
                             Hapus
                          </a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </div>
                <div class="tab-pane" id="penarikan">
                    <table class="table table-striped table-bordered">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">ID Transaksi</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Jumlah</th>
                          <th scope="col">Catatan</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      @php $no=1; @endphp
                      @forelse ($penarikan as $penarikans)
                      <tbody>
                        <tr>
                          <td>{{$no++}}</td>
                          <td>P100{{$penarikans->id_penarikan}}</td>
                          <td>{{$penarikans->name}}</td>
                          <td>{{$penarikans->tgl}}</td>
                          <td>@currency($penarikans->jumlah)</td>
                          <td>{{$penarikans->catatan}}</td>
                          <td>
                            <div class="text-right">
                              <a href="/penarikan/print/{{$penarikans->id_penarikan}}" rel="noopener" target="blank"  class="btn btn-sm btn-dark">
                                <i class="fas fa-print"></i>
                              </a>
                              <a href="/anggota/profile/editpenarikan/{{$penarikans->id_penarikan}}" class="btn btn-sm btn-success">
                                <i class="fas fa-pencil-alt"></i>
                              </a>
                              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-penarikan" onclick="pass_id_penarikan({{$penarikans->id_penarikan}})">
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
                    <div class="modal fade" id="modal-hapus-penarikan">
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
                            <a id="modal_delete_penarikan" href="#" methode="post" class="btn btn-sm btn-danger">
                               Hapus
                            </a>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div>
                </div>
                <div class="tab-pane" id="kredit">
                    @forelse ($kredit as $kredits)
                    <div class="row">
                      <div class="col-md-4">
                        <div class="card card-widget widget-user-2">
                          <div class="pl-2 pt-2 bg-info">
                            <div class="row">
                              <div class="col-md-9">
                                <h5>{{$kredits->nama_barang}}</h5>
                                <h6>K100{{$kredits->id_kredit}} | {{$kredits->tgl}}</h6>
                                <h6>{{$kredits->no_anggota}} - {{$kredits->name}}</h6>
                                @if ($kredits->surat_kredit == null)
                                @else
                                  <h6>
                                    <a href="/suratkredit/{{$kredits->surat_kredit}}" class="h6">
                                      <i class="fas fa-copy"></i> {{$kredits->surat_kredit}}
                                    </a>
                                  </h6>
                                @endif
                              </div>
                              <div class="col-md-3">
                                @if ($kredits->sisa_kredit == 0)
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
                                  Jumlah <span class="float-right text-bold">{{$kredits->jumlah}} x @currency($kredits->harga)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Total Harga <span class="float-right text-bold">Rp @currency($kredits->total_harga)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Total Kredit <span class="float-right text-bold">Rp @currency($kredits->total_kredit)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Jumlah Angsuran
                                  <span class="float-right text-bold">{{$kredits->lama_angsuran}} x
                                    @php
                                        $lamaangsuran = $kredits->lama_angsuran;
                                        $maximalangsuran = $kredits->maximal_angsuran;
                                        $totalharga = $kredits->total_harga;
                                        $prosentasekeuntungan = $kredits->prosentase_keuntungankredit;
                                        $keuntungan = ($lamaangsuran/$maximalangsuran)*($prosentasekeuntungan/100);
                                        $totalkeuntungan = $totalharga * $keuntungan;
                                        $angsuranbulanan = ($totalharga + $totalkeuntungan) / $lamaangsuran;
                                    @endphp
                                    <b>@currency($angsuranbulanan)</b>
                                  </span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Jatuh Tempo <span class="float-right text-bold">{{$kredits->jatuh_tempo}}</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Sisa Kredit <span class="float-right text-bold">@currency($kredits->sisa_kredit)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  <div class="row">
                                    <div class="col-md-10">
                                        Prosentase Dana Cadangan<br>
                                        Prosentase Dana Sosial <br>
                                        Prosentase SHU Pengurus <br>
                                        Prosentase SHU Anggota 
                                      </div>
                                    <div class="float-right text-bold">
                                        {{$kredits->prosentase_danacadangan}}%<br>
                                        {{$kredits->prosentase_danasosial}}%<br>
                                        {{$kredits->prosentase_shupengurus}}%<br>
                                        {{$kredits->prosentase_shuanggota}}%
                                    </div>
                                  </div>
                                </h6>
                              </li>
                              <li class="nav-item col-md-12">
                                <h6 class="pl-2 nav-link text-bold">
                                  Keterangan
                                </h6>
                                <p class="pl-2">{{$kredits->keterangan}}</p>
                              </li>
                            </ul>
                          </div>
                          <div class="card-footer">
                            <div class="text-right">
                              <a href="/kredit/print/{{$kredits->id_kredit}}" rel="noopener" target="_blank"  class="btn btn-sm btn-dark">
                                <i class="fas fa-print"></i>
                              </a>
                              <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-surat-kredit" onclick="pass_id_kredit({{$kredits->id_kredit}})">
                                <i class="fas fa-upload"></i>
                              </button>
                              <a href="/anggota/profile/editkredit/{{$kredits->id_kredit}}" class="btn btn-sm btn-primary">
                                <i class="fas fa-pencil-alt"></i>
                              </a>
                              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-kredit" onclick="pass_id_kredit({{$kredits->id_kredit}})">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="modal-surat-kredit">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Upload file surat perjanjian kredit</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="/upload/suratkredit/{{$kredits->id_kredit}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="containerup">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Upload file dalam bentuk PDF</label>
                                    <div class="preview-zoneup hidden">
                                      <div class="boxup box-solid">
                                        <div class="box-headerup with-border">
                                          <div class="box-toolsrup pull-right">
                                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                                              <i class="fa fa-times"></i> Reset file
                                            </button>
                                          </div>
                                        </div>
                                        <div class="box-body"></div>
                                      </div>
                                    </div>
                                    <div class="dropzone-wrapperup">
                                      <div class="dropzone-descup">
                                        <i class="fa fa-upload"></i>
                                        <p>Pilih atau drag file disini</p>
                                      </div>
                                      <input type="file" name="file_suratkredit" class="dropzoneup">
                                    </div>
                                  </div>
                                </div>
                              </div>
                          
                              <div class="row">
                                <div class="col-md-12">
                                  <button type="submit" class="btn btn-primary pull-right">Upload</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="modal-hapus-kredit">
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
                            <a id="modal_delete_kredit" href="#" methode="post" class="btn btn-sm btn-danger">
                               Hapus
                            </a>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    @empty
                        <div class="alert alert-danger text-center col-md-4">
                          Data masih kosong
                        </div>
                    @endforelse
                </div>
                <div class="tab-pane" id="qordh">
                    @forelse ($qordh as $qordhs)
                    <div class="row">
                      <div class="col-md-4">
                        <div class="card card-widget widget-user-2">
                          <div class="pl-4 bg-success">
                            <div class="row">
                              <div class="col-md-9  pt-4">
                                <h5 class="text-bold">{{$qordhs->no_anggota}} - {{$qordhs->name}}</h5>
                                <h6>H100{{$qordhs->id_qordh}} | {{$qordhs->tgl}}</h6>
                                @if ($qordhs->surat_qordh == null)
                                @else
                                  <h6>
                                    <a href="/suratqordh/{{$qordhs->surat_qordh}}" class="h6">
                                      <i class="fas fa-copy"></i> {{$qordhs->surat_qordh}}
                                    </a>
                                  </h6>
                                @endif
                              </div>
                              <div class="col-md-3 pt-2">
                                @if ($qordhs->sisa_qordh == 0)
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
                                  Jumlah <span class="float-right text-bold">Rp @currency($qordhs->jumlah)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Jumlah Angsuran <span class="float-right text-bold">{{$qordhs->lama_angsuran}} x @currency($qordhs->jumlah/$qordhs->lama_angsuran)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Jatuh Tempo <span class="float-right text-bold">{{$qordhs->jatuh_tempo}}</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Sisa Hutang <span class="float-right text-bold">Rp @currency($qordhs->sisa_qordh)</span>
                                </h6>
                              </li>
                              <li class="nav-item col-md-12">
                                <h6 class="pl-2 nav-link text-bold">
                                  Keterangan
                                </h6>
                                <p class="pl-2">{{$qordhs->keterangan}}</p>
                              </li>
                              <div class="card-footer">
                                <div class="text-right">
                                  <a href="/qordh/print/{{$qordhs->id_qordh}}" class="btn btn-sm btn-dark">
                                    <i class="fas fa-print"></i>
                                  </a>
                                  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-surat-qordh" onclick="pass_id_kredit({{$qordhs->id_qordh}})">
                                    <i class="fas fa-upload"></i>
                                  </button>
                                  <a href="/anggota/profile/editqordh/{{$qordhs->id_qordh}}" class="btn btn-sm btn-success">
                                      <i class="fas fa-pencil-alt"></i>
                                  </a>
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-qordh" onclick="pass_id_qordh({{ $qordhs->id_qordh}})">
                                    <i class="fas fa-trash-alt"></i>
                                  </button>
                                </div>
                              </div>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="modal-surat-qordh">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Upload file surat perjanjian kredit</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="/upload/suratqordh/{{$qordhs->id_qordh}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="containerup">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Upload file dalam bentuk PDF</label>
                                    <div class="preview-zoneup hidden">
                                      <div class="boxup box-solid">
                                        <div class="box-headerup with-border">
                                          <div class="box-toolsrup pull-right">
                                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                                              <i class="fa fa-times"></i> Reset file
                                            </button>
                                          </div>
                                        </div>
                                        <div class="box-body"></div>
                                      </div>
                                    </div>
                                    <div class="dropzone-wrapperup">
                                      <div class="dropzone-descup">
                                        <i class="fa fa-upload"></i>
                                        <p>Pilih atau drag file disini</p>
                                      </div>
                                      <input type="file" name="file_suratqordh" class="dropzoneup">
                                    </div>
                                  </div>
                                </div>
                              </div>
                          
                              <div class="row">
                                <div class="col-md-12">
                                  <button type="submit" class="btn btn-primary pull-right">Upload</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="modal-hapus-qordh">
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
                            <a id="modal_delete_qordh" href="#" methode="post" class="btn btn-sm btn-danger">
                                Hapus
                            </a>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    @empty
                        <div class="alert alert-danger text-center col-md-4">
                          Data masih kosong
                        </div>
                    @endforelse
                </div>
                <div class="tab-pane" id="mudorobah">
                    @forelse ($mudorobah as $mudorobahs)
                    <div class="row">
                      <div class="col-md-4">
                        <div class="card card-widget widget-user-2">
                          <div class="pl-2 pt-2 bg-warning">
                            <div class="row">
                              <div class="col-md-9">
                                <h5>{{$mudorobahs->jenis_usaha}}</h5>
                                <h6>M100{{$mudorobahs->id_mudorobah}} | {{$mudorobahs->tgl}}</h6>
                                <h6>{{$mudorobahs->no_anggota}} - {{$mudorobahs->name}}</h6>
                                @if ($mudorobahs->surat_mudorobah == null)
                                @else
                                  <h6>
                                    <a href="/suratmudorobah/{{$mudorobahs->surat_mudorobah}}" class="h6">
                                    <i class="fas fa-copy"></i> {{$mudorobahs->surat_mudorobah}}
                                  </a>
                                </h6>
                                @endif
                              </div>
                              <div class="col-md-3">
                                @if ($mudorobahs->sisa_hutang == 0)
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
                                  Jumlah <span class="float-right text-bold">Rp @currency($mudorobahs->jumlah)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Bagi Hasil <span class="float-right text-bold">{{$mudorobahs->bagi_hasil}}%</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Berakhir <span class="float-right text-bold">{{$mudorobahs->berakhir}}</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Sisa Hutang <span class="float-right text-bold">Rp @currency($mudorobahs->sisa_hutang)</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Penanggungjawab <span class="float-right text-bold">{{$mudorobahs->penanggungjawab}}</span>
                                </h6>
                              </li>
                              <li class="nav-item">
                                <h6 class="nav-link">
                                  Saksi <span class="float-right text-bold">{{$mudorobahs->saksi}}</span>
                                </h6>
                              </li>
                              <li class="nav-item col-md-12">
                                <h6 class="pl-2 nav-link text-bold">
                                  Keterangan
                                </h6>
                                <p class="pl-2">{{$mudorobahs->keterangan}}</p>
                              </li>
                              <div class="card-footer">
                                <div class="text-right">
                                  <a href="/mudorobah/print/{{$mudorobahs->id_mudorobah}}" class="btn btn-sm btn-dark">
                                    <i class="fas fa-print"></i>
                                  </a>
                                  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-surat-mudorobah" onclick="pass_id_mudorobah({{$mudorobahs->id_mudorobah}})">
                                    <i class="fas fa-upload"></i>
                                  </button>
                                  <a href="/anggota/profile/editmudorobah/{{$mudorobahs->id_mudorobah}}" class="btn btn-sm btn-success">
                                    <i class="fas fa-pencil-alt"></i>
                                  </a>
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-mudorobah" onclick="pass_id_mudorobah({{$mudorobahs->id_mudorobah}})">
                                    <i class="fas fa-trash-alt"></i>
                                  </button>
                              </div>
                            </ul>
                          </div>
                        </div>
                        <!-- /.widget-user -->
                      </div>
                    </div>
                    <div class="modal fade" id="modal-hapus-mudorobah">
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
                            <a id="modal_delete_mudorobah" href="#" methode="post" class="btn btn-sm btn-danger">
                               Hapus
                            </a>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <div class="modal fade" id="modal-surat-mudorobah">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Upload file surat perjanjian kredit</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="/upload/suratmudorobah/{{$mudorobahs->id_mudorobah}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="containerup">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Upload file dalam bentuk PDF</label>
                                    <div class="preview-zoneup hidden">
                                      <div class="boxup box-solid">
                                        <div class="box-headerup with-border">
                                          <div class="box-toolsrup pull-right">
                                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                                              <i class="fa fa-times"></i> Reset file
                                            </button>
                                          </div>
                                        </div>
                                        <div class="box-body"></div>
                                      </div>
                                    </div>
                                    <div class="dropzone-wrapperup">
                                      <div class="dropzone-descup">
                                        <i class="fa fa-upload"></i>
                                        <p>Pilih atau drag file disini</p>
                                      </div>
                                      <input type="file" name="file_suratmudorobah" class="dropzoneup">
                                    </div>
                                  </div>
                                </div>
                              </div>
                          
                              <div class="row">
                                <div class="col-md-12">
                                  <button type="submit" class="btn btn-primary pull-right">Upload</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    @empty
                        <div class="alert alert-danger text-center col-md-4">
                          Data masih kosong
                        </div>
                    @endforelse
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Setoran Keuntungan Mudorobah</h3>
                      </div>
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
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $no=1; @endphp
                          @forelse ($keuntunganmudorobah as $datas)
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
                            <td>
                              <div class="text-right">
                                <a href="/keuntungan/print/{{$datas->id_keuntungan}}" rel="noopener" target="blank"  class="btn btn-sm btn-dark">
                                  <i class="fas fa-print"></i>
                                </a>
                                <a href="/anggota/profile/editkeuntungan/{{$datas->id_keuntungan}}" class="btn btn-sm btn-success">
                                  <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-keuntungan" onclick="pass_id_keuntungan({{$datas->id_keuntungan}})">
                                  <i class="fas fa-trash-alt"></i>
                                </button>
                              </div>
                            </td>
                          </tr>                         
                          @empty
                              <div class="alert alert-danger text-center col-md-4">
                                Data belum tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                    <div class="modal fade" id="modal-hapus-keuntungan">
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
                            <a id="modal_delete_keuntungan" href="#" methode="post" class="btn btn-sm btn-danger">
                               Hapus
                            </a>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                </div>
                <div class="tab-pane" id="angsuran">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Angsuran</th>
                        <th>ID Angsuran</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal</th>
                        <th>Data Akad</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                  {{-- Angsuran Kredit --}}
                    <tbody>
                      @forelse ($angsuranKredit as $angsurankredits)
                      <tr>
                        <td>Kredit</td>
                        <td>A100{{$angsurankredits->id_angsuran_kredit}}</td>
                        <td>{{$angsurankredits->no_anggota}} - {{$angsurankredits->name}}</td>
                        <td>{{$angsurankredits->tgl}}</td>
                        <td>Kredit | {{$angsurankredits->data_kredit}}</td>
                        <td>@currency($angsurankredits->jumlah_angsuran)</td>
                        <td>{{$angsurankredits->keterangan}}</td>
                        <td>
                          <div class="text-right">
                            <a href="/angsuran/kredit/print/{{$angsurankredits->id_angsuran_kredit}}" rel="noopener" target="blank"  class="btn btn-sm btn-dark">
                              <i class="fas fa-print"></i>
                            </a>
                            <a href="/anggota/profile/editangsurankredit/{{$angsurankredits->id_angsuran_kredit}}" class="btn btn-sm btn-success">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-angsurankredit" onclick="pass_id_angsurankredit({{$angsurankredits->id_angsuran_kredit}})">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </td>
                      </tr>                         
                      @empty
                          <div class="alert alert-danger text-center col-md-4">
                            Data Angsuran Kredit belum tersedia
                          </div>
                      @endforelse
                    </tbody>
                  {{-- Angsuran Qordh --}}
                    <tbody>
                      @forelse ($angsuranQordh as $angsuranqordhs)
                      <tr>
                        <td>Hutang</td>
                        <td>A200{{$angsuranqordhs->id_angsuran_qordh}}</td>
                        <td>{{$angsuranqordhs->no_anggota}} - {{$angsuranqordhs->name}}</td>
                        <td>{{$angsuranqordhs->tgl}}</td>
                        <td>Hutang | {{$angsuranqordhs->data_qordh}}</td>
                        <td>@currency($angsuranqordhs->jumlah_angsuran)</td>
                        <td>{{$angsuranqordhs->keterangan}}</td>
                        <td>
                          <div class="text-right">
                            <a href="/angsuran/qordh/print/{{$angsuranqordhs->id_angsuran_qordh}}" rel="noopener" target="blank"  class="btn btn-sm btn-dark">
                              <i class="fas fa-print"></i>
                            </a>
                            <a href="/anggota/profile/editangsuranqordh/{{$angsuranqordhs->id_angsuran_qordh}}" class="btn btn-sm btn-success">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-angsuranqordh" onclick="pass_id_angsuranqordh({{$angsuranqordhs->id_angsuran_qordh}})">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </td>
                      </tr>                         
                      @empty
                          <div class="alert alert-danger text-center col-md-4">
                            Data Angsuran Hutang belum tersedia
                          </div>
                      @endforelse
                    </tbody>
                  {{-- Angsuran Mudorobah --}}
                    <tbody>
                      @forelse ($angsuranMudorobah as $angsuranmudorobahs)
                      <tr>
                        <td>Mudorobah</td>
                        <td>A300{{$angsuranmudorobahs->id_angsuran_mudorobah}}</td>
                        <td>{{$angsuranmudorobahs->no_anggota}} - {{$angsuranmudorobahs->name}}</td>
                        <td>{{$angsuranmudorobahs->tgl}}</td>
                        <td>Mudorobah | {{$angsuranmudorobahs->data_mudorobah}}</td>
                        <td>@currency($angsuranmudorobahs->jumlah_angsuran)</td>
                        <td>{{$angsuranmudorobahs->keterangan}}</td>
                        <td>
                          <div class="text-right">
                            <a href="/angsuran/mudorobah/print/{{$angsuranmudorobahs->id_angsuran_mudorobah}}" rel="noopener" target="blank"  class="btn btn-sm btn-dark">
                              <i class="fas fa-print"></i>
                            </a>
                            <a href="/anggota/profile/editangsuranmudorobah/{{$angsuranmudorobahs->id_angsuran_mudorobah}}" class="btn btn-sm btn-success">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus-angsuranmudorobah" onclick="pass_id_angsuranmudorobah({{$angsuranmudorobahs->id_angsuran_mudorobah}})">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </td>
                      </tr>                         
                      @empty
                          <div class="alert alert-danger text-center col-md-4">
                            Data Angsuran Mudorobah belum tersedia
                          </div>
                      @endforelse
                    </tbody>
                  </table>
                  <div class="modal fade" id="modal-hapus-angsurankredit">
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
                          <a id="modal_delete_angsurankredit" href="#" methode="post" class="btn btn-sm btn-danger">
                             Hapus
                          </a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <div class="modal fade" id="modal-hapus-angsuranqordh">
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
                          <a id="modal_delete_angsuranqordh" href="#" methode="post" class="btn btn-sm btn-danger">
                             Hapus
                          </a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <div class="modal fade" id="modal-hapus-angsuranmudorobah">
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
                          <a id="modal_delete_angsuranmudorobah" href="#" methode="post" class="btn btn-sm btn-danger">
                             Hapus
                          </a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </div>
                {{-- <div class="tab-pane" id="tabungan">
                  <div class="row col-12">
                    <div class="col-5">
                      <form action="/tabungan/print/debit/{{$detail->id_anggota}}" method="POST">
                      @csrf
                        <div class="form-group">
                          <label>Pilih Tanggal Transaksi Debit</label>
                          <div class="input-group date" id="reservationdatetrx" data-target-input="nearest">
                              <input type="text" style="display: none" name="id_anggota" value="{{$detail->id_anggota}}">
                              <input id="tgltrx" name="tgltrx" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdatetrx" placeholder="Tanggal Transaksi" value="{{old('tgltrx')}}"/>
                                  @if ($errors->has('tgltrx'))
                                  <span class="text-danger">{{ $errors->first('tgltrx') }}</span>
                                  @endif
                              <div class="input-group-append" data-target="#reservationdatetrx" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        <button type="submit" class="btn btn-sm btn-dark" target="_blank">
                          <i class="fas fa-print"></i> Debit
                        </button>
                      </form>
                      <hr>
                      <form action="/tabungan/print/kredit/{{$detail->id_anggota}}" method="POST">
                        @csrf
                          <div class="form-group">
                            <label>Pilih Tanggal Transaksi Kredit</label>
                            <div class="input-group date" id="reservationdatetrx" data-target-input="nearest">
                                <input type="text" style="display: none" name="id_anggota" value="{{$detail->id_anggota}}">
                                <input id="tgltrx" name="tgltrx" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdatetrx" placeholder="Tanggal Transaksi" value="{{old('tgltrx')}}"/>
                                    @if ($errors->has('tgltrx'))
                                    <span class="text-danger">{{ $errors->first('tgltrx') }}</span>
                                    @endif
                                <div class="input-group-append" data-target="#reservationdatetrx" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          <button type="submit" class="btn btn-sm btn-dark" target="_blank">
                            <i class="fas fa-print"></i> Kredit
                          </button>
                        </form>
                    </div>
                  </div>
                  
                  <div class="col-md-2 float-left">
                    <a href="/tabungan/print/debit/{{$detail->id_anggota}}" rel="noopener" target="_blank" style="padding: 10px"  class="btn btn-sm btn-dark float-right">
                      <i class="fas fa-print"></i> Debit 
                    </a>
                  </div>
                  <div class="col-md-2 float-left">
                    <a href="/tabungan/print/kredit/{{$detail->id_anggota}}" rel="noopener" target="_blank" style="padding: 10px"  class="btn btn-sm btn-dark float-right">
                      <i class="fas fa-print"></i> Kredit 
                    </a>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('script')
  <script type="text/javascript">
  
    $('#reservationdatetrx').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    function pass_id_simpanan(id) {
      var delete_button = document.getElementById("modal_delete_simpanan");
      delete_button.href = "/anggota/profile/hapussimpanan/"+id;
    }
    function pass_id_simpananlain(id) {
      var delete_button = document.getElementById("modal_delete_simpananlain");
      delete_button.href = "/anggota/profile/hapussimpanan/"+id;
    }
    function pass_id_penarikan(id) {
      var delete_button = document.getElementById("modal_delete_penarikan");
      delete_button.href = "/anggota/profile/hapuspenarikan/"+id;
    }
    function pass_id_kredit(id) {
      var delete_button = document.getElementById("modal_delete_kredit");
      delete_button.href = "/anggota/profile/hapuskredit/" + id;
    }
    function pass_id_qordh(id) {
      var delete_button = document.getElementById("modal_delete_qordh");
      delete_button.href = "/anggota/profile/hapusqordh/" + id;
    }
    function pass_id_mudorobah(id) {
      var delete_button = document.getElementById("modal_delete_mudorobah");
      delete_button.href = "/anggota/profile/hapusmudorobah/" + id;
    }
    function pass_id_keuntungan(id) {
      var delete_button = document.getElementById("modal_delete_keuntungan");
      delete_button.href = "/anggota/profile/hapuskeuntungan/" + id;
    }
    function pass_id_angsurankredit(id) {
      var delete_button = document.getElementById("modal_delete_angsurankredit");
      delete_button.href = "/anggota/profile/hapusangsurankredit/" + id;
    }
    function pass_id_angsuranqordh(id) {
      var delete_button = document.getElementById("modal_delete_angsuranqordh");
      delete_button.href = "/anggota/profile/hapusangsuranqordh/" + id;
    }
    function pass_id_angsuranmudorobah(id) {
      var delete_button = document.getElementById("modal_delete_angsuranmudorobah");
      delete_button.href = "/anggota/profile/hapusangsuranmudorobah/" + id;
    }

    // Code By Webdevtrick ( https://webdevtrick.com )
    function readFile(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          var htmlPreview =
            '<img width="200" src="' + e.target.result + '" />' +
            '<p>' + input.files[0].name + '</p>';
          var wrapperZone = $(input).parent();
          var previewZone = $(input).parent().parent().find('.preview-zoneup');
          var boxZone = $(input).parent().parent().find('.preview-zoneup').find('.boxup').find('.box-body');

          wrapperZone.removeClass('dragoverup');
          previewZone.removeClass('hidden');
          boxZone.empty();
          boxZone.append(htmlPreview);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function reset(e) {
      e.wrap('<form>').closest('form').get(0).reset();
      e.unwrap();
    }

    $(".dropzoneup").change(function() {
      readFile(this);
    });

    $('.dropzone-wrapperup').on('dragoverup', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).addClass('dragoverup');
    });

    $('.dropzone-wrapperup').on('dragleave', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).removeClass('dragoverup');
    });

    $('.remove-preview').on('click', function() {
      var boxZone = $(this).parents('.preview-zoneup').find('.box-body');
      var previewZone = $(this).parents('.preview-zoneup');
      var dropzoneup = $(this).parents('.form-group').find('.dropzoneup');
      boxZone.empty();
      previewZone.addClass('hidden');
      reset(dropzoneup);
    });
  </script>
@endsection