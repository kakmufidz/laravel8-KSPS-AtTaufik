@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Jenis Simpanan</h1>
        </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Jenis Simpanan</h3>
                        </div>
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                        {{session('statusdg')}}
                        </div>
                        @endif
                        <div class="card-body">
                          <form action="/jsimpanan/update/{{$jenis_simpanan->id_jenis}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="jenis_dana">Jenis Dana</label>
                                <select id="jenis_dana" class="form-control" name="jenis_dana" value="{{$jenis_simpanan->jenis_dana}}">
                                    <option>Dana Aman</option>
                                    <option>Dana Cadangan</option>
                                    <option>Dana Sosial</option>
                                </select>
                                @if ($errors->has('jenis_dana'))
                                <span class="text-danger">{{ $errors->first('jenis_dana') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                  <label for="new_simpanan">Nama Simpanan</label>
                                  <input type="text" class="form-control" name="new_simpanan" placeholder="Jenis simpanan baru" value="{{$jenis_simpanan->kategori}}">
                                  @if ($errors->has('new_simpanan'))
                                  <span class="text-danger">{{ $errors->first('new_simpanan') }}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                <label for="minimal">Minimal Nominal</label>
                                <input type="text" class="form-control" name="minimal" placeholder="Minimal" value="{{$jenis_simpanan->minimal}}">
                                  @if ($errors->has('minimal'))
                                  <span class="text-danger">{{ $errors->first('minimal') }}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                <label for="maksimal">Maksimal Nominal</label>
                                <input type="text" class="form-control" name="maksimal" placeholder="Maksimal" value="{{$jenis_simpanan->maksimal}}">
                                  @if ($errors->has('maksimal'))
                                  <span class="text-danger">{{ $errors->first('maksimal') }}</span>
                                  @endif
                              </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection