@extends('layouts.master')
@section('konten')
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Master Data</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="#">Master Data</a></li>
          </ol>
        </div>
      </div>  
    </div>
  </div>
  <!-- /.content-header -->
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
  <!-- Konten Utama Anggota -->
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        @if (empty($mdata))
          <div class="card">
            <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fas fa-times"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Anda belum mengatur data utama</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <div class="card-header bg-danger">
              <h3 class="card-title">Masukan Data Utama</h3>
            </div>
            <div class="card-body">
              <form action="/mdata/tambah" method="POST">
                @csrf
                <div class="form-group">
                    <label for="qordh">Maksimal Hutang</label>
                    <input type="text" class="form-control" name="qordh" placeholder="Maksimal Hutang" value="{{old('qordh')}}">
                    @if ($errors->has('qordh'))
                    <span class="text-danger">{{ $errors->first('qordh') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="keuntungan">Prosentase Keuntungan</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control col-sm-3" name="keuntungan" placeholder="0" value="{{old('keuntungan')}}">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    @if ($errors->has('keuntungan'))
                    <span class="text-danger">{{ $errors->first('keuntungan') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="danacadangan">Prosentase Dana Cadangan</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control col-sm-3" name="danacadangan" placeholder="0" value="{{old('danacadangan')}}">
                      <div class="input-group-append">
                          <span class="input-group-text">%</span>
                      </div>
                    </div>
                    @if ($errors->has('danacadangan'))
                    <span class="text-danger">{{ $errors->first('danacadangan') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="danasosial">Prosentase Dana Sosial</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control col-sm-3" name="danasosial" placeholder="0" value="{{old('danasosial')}}">
                      <div class="input-group-append">
                          <span class="input-group-text">%</span>
                      </div>
                    </div>
                    @if ($errors->has('danasosial'))
                    <span class="text-danger">{{ $errors->first('danasosial') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="shupengurus">Prosentase SHU Pengurus</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control col-sm-3" name="shupengurus" placeholder="0" value="{{old('shupengurus')}}">
                      <div class="input-group-append">
                          <span class="input-group-text">%</span>
                      </div>
                    </div>
                    @if ($errors->has('shupengurus'))
                    <span class="text-danger">{{ $errors->first('shupengurus') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="shuanggota">Prosentase SHU Anggota</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control col-sm-3" name="shuanggota" placeholder="0" value="{{old('shuanggota')}}">
                      <div class="input-group-append">
                          <span class="input-group-text">%</span>
                      </div>
                    </div>
                    @if ($errors->has('shuanggota'))
                    <span class="text-danger">{{ $errors->first('shuanggota') }}</span>
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        @else
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Utama</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Task</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1.</td>
                    <td>Maksimal Hutang</td>
                    <td>@currency($mdata->qordh)</td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>Prosentase Keuntungan</td>
                    <td>{{$mdata->prosentase_keuntungan}} %</td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>Prosentase Dana Cadangan</td>
                    <td>{{$mdata->prosentase_danacadangan}} %</td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>Prosentase Dana Sosial</td>
                    <td>{{$mdata->prosentase_danasosial}} %</td>
                  </tr>
                  <tr>
                    <td>5.</td>
                    <td>Prosentase SHU Pengurus</td>
                    <td>{{$mdata->prosentase_shupengurus}} %</td>
                  </tr>
                  <tr>
                    <td>6.</td>
                    <td>Prosentase SHU Anggota</td>
                    <td>{{$mdata->prosentase_shuanggota}} %</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="text-right">
                <a href="/mdata/edit/{{$mdata->id}}" class="btn btn-sm btn-success">
                    Edit
                </a>
              </div>
            </div>
          </div>
        @endif
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Jenis Simpanan</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Jenis</th>
                  <th>Dana</th>
                  <th>Minimal</th>
                  <th>Maksimal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $no=1; @endphp
                @forelse ($jenis_simpanan as $item)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$item->kategori}}</td>
                      <td>{{$item->jenis_dana}}</td>
                      <td>{{$item->minimal}}</td>
                      <td>{{$item->maksimal}}</td>
                      <td>
                        <div class="text-right">
                          <a href="/jsimpanan/edit/{{$item->id_jenis}}" class="btn btn-sm btn-success">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-sm" onclick="pass_id_to_modal({{$item->id_jenis}})">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                @empty
                  <div class="alert alert-danger text-center">
                      Tidak ada jenis simpanan baru
                  </div>
                @endforelse
              </tbody>
            </table>
          </div>
          {{-- <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Jenis</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $no=1; @endphp
                @forelse ($simpanan as $item)
                  @if ($item == 'id_simpanan')
                  @elseif($item =='anggota_id_anggota')
                  @elseif($item =='tgl')
                  @elseif($item =='catatan')
                  @elseif($item =='created_at')
                  @elseif($item =='updated_at')
                  @else
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$item}}</td>
                      <td>
                        @if ($item =='registrasi')
                        @elseif($item =='s_wajib')
                        @elseif($item =='tabungan')
                        @elseif($item =='s_pokok')
                        @else
                          <div class="text-center">
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-sm">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        @endif
                      </td>
                    </tr>
                  @endif
                @empty
                    
                @endforelse
              </tbody>
            </table>
          </div> --}}
          <div class="card-footer">
            <div class="text-right">
              <a href="/jsimpanan" class="btn btn-sm btn-primary">
                  + Tambah Jenis Simpanan
              </a>
            </div>
          </div>
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
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">
  function pass_id_to_modal(id) {
    var delete_button = document.getElementById("modal_delete_link");
    delete_button.href = "/jsimpanan/delete/" + id;
  }
</script>
@endsection