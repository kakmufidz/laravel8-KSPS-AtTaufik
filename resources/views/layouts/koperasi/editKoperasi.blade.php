@extends('layouts.master')
@section('konten')
<div class="content-header">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ganti Data Koperasi</h3>
                        </div>
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                            {{session('statusdg')}}
                        </div>
                        @endif
                        <form action="/koperasi/update/{{$koperasi->id}}" method="post">
                            @csrf
                            <!--card-body -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="nama_koperasi">Nama Koperasi</label>
                                    <input type="text" class="form-control" name="nama_koperasi" placeholder="Nama Koperasi" value="{{$koperasi->nama_koperasi}}">
                                    @if ($errors->has('nama_koperasi'))
                                    <span class="text-danger">{{ $errors->first('nama_koperasi') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="no_kantor">Nomor Kantor</label>
                                    <input type="text" class="form-control" name="no_kantor" placeholder="Nomor Kantor" value="{{$koperasi->no_kantor}}">
                                    @if ($errors->has('no_kantor'))
                                    <span class="text-danger">{{ $errors->first('no_kantor') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" rows="3" name="alamat" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">{{$koperasi->alamat}}</textarea>
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
@endsection