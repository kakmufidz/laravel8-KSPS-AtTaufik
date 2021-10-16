@extends('layouts.master')
@section('konten')
    
  <!-- Konten Search -->
  <div class="container">
    <div class="row">
      @foreach ($cari_anggota as $angg)
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="d-md-flex">
              <div class="col-5 text-center">
                <img src="{{asset('')}}assets/dist/img/avatar1.png" alt="user-avatar" class="img-circle img-fluid">
                <div class="btn btn-primary mt-2">View Profile</div>
              </div>
              <div class="col-7">
                <h3 class="lead"><b>{{$angg->nama}}</b></h3>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li><span class="fa-li"><i class="fas fa-lg fa-user small"></i></span> No. Anggota: {{$angg->no_anggota}}</li>
                  <li><span class="fa-li"><i class="fa-phone"></i></span> Phone: {{$angg->hp}}</li>
                  <li><span class="fa-li"><i class="fas fa-lg fa-building small"></i></span> Alamat: {{$angg->alamat}}</li>
                </ul>
                <p class="text-muted text-sm pt-2"><b>Bergabung Sejak: </b>20/09/2020</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      </div>
    </div>
    <div class="d-flex justify-content-center">{{$anggota->links()}}</div>
  </div>

@endsection