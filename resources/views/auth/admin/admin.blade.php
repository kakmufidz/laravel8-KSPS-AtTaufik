@extends('layouts.master')
@section('konten')
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Daftar Admin</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Admin</li>
          </ol>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>0</h3>

              <p>Jumlah Admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info-box shadow">
            <span class="info-box-icon bg-warning"><i class="far fa-plus-square"></i></span>
            <div class="info-box-content">
              <a href="/admin/tambah" class="btn btn-primary btn-block">Tambah Admin</a>
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
@if (session('statusdg'))
  <div class="alert alert-danger">
    {{session('status')}}
  </div>
@endif
  <!-- Konten Utama Anggota -->
  <div class="card-body">
    <table class="table table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Nama</th>
          <th scope="col">Username</th>
          <th scope="col">Password</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      @php $no=1; @endphp
      @forelse ($admin as $data)
      <tbody>
        <tr>
          <td>{{$no++}}</td>
          <td>{{$data->name}}</td>
          <td>{{$data->username}}</td>
          <td>...........</td>
          <td>
            <div class="text-right">
              <a href="/admin/edit/{{$data->id}}" class="btn btn-sm btn-success">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-sm" onclick="pass_id_to_modal({{ $data->id}})">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
      @empty
        <div class="alert alert-danger text-center">
            Data Admin belum tersedia
        </div>
      @endforelse
    </table>
  </div>
@endsection