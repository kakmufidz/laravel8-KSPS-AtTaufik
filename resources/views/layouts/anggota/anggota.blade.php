@extends('layouts.master')
@section('konten')
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Anggota</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Anggota</li>
          </ol>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$jumlah_anggota}}</h3>

              <p>Jumlah Anggota</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info-box shadow">
            <span class="info-box-icon bg-warning"><i class="far fa-plus-square"></i></span>
            <div class="info-box-content">
              <a href="/anggota/tambah" class="btn btn-primary btn-block">Tambah Anggota</a>
            </div>
          </div>
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
@if (session('statuswn'))
<div class="alert alert-warning">
  {{session('status')}}
</div>
@endif
@if (session('statusdg'))
  <div class="alert alert-danger">
    {{session('status')}}
  </div>
@endif
  <div class="container">
    <div class="row">
      @forelse ($anggota as $anggotas)
      <div class="col-md-4">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="d-md-flex">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                      src="{{asset('')}}uploads/avatars/{{$anggotas->image}}" 
                      style="object-fit:cover; width:150px; height:130px;"
                      alt="User profile picture">
              </div>
              <div class="col-7">
                <h3 class="lead"><b>{{$anggotas->name}}</b></h3>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li><span class="fa-li"><i class="fas fa-lg fa-user small"></i></span> No. Anggota: {{$anggotas->id_anggota}}</li>
                  <li><span class="fa-li"><i class="fa-phone"></i></span> Phone: {{$anggotas->hp}}</li>
                  <li><span class="fa-li"><i class="fas fa-lg fa-building small"></i></span> Alamat: {{$anggotas->alamat}}</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="/anggota/profile/{{$anggotas->id_anggota}}" class="btn btn-sm btn-primary">
                 View Profile
              </a>
              <a href="/anggota/edit/{{$anggotas->id_anggota}}" class="btn btn-sm btn-success">
                 Edit
              </a>
              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-sm" onclick="pass_id_to_modal({{$anggotas->id}})">
                 Hapus
              </button>
            </div>
          </div>
        </div>
      </div>
      @empty
        <div class="alert alert-danger text-center col-md-4">
          Data anggota belum tersedia
        </div>
      @endforelse
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
            <p>Data yang dihapus tidak dapat kembali&hellip;</p><br>
            Termasuk data Simpanan, penarikan, hutang, dan angsuran&hellip;
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <a id="modal_link" href="#" methode="post" class="btn btn-sm btn-danger">
               Hapus
            </a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <div class="d-flex justify-content-center">{{$anggota->links()}}</div>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    function pass_id_to_modal(id) {
      var delete_button = document.getElementById("modal_link");
      delete_button.href = "/anggota/hapus/" + id;
    }
  </script>
@endsection