@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Data Anggota</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Anggota</a></li>
            <li class="breadcrumb-item active">Edit Anggota</li>
          </ol>
        </div><!-- /.col -->
      </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">Data Anggota</h3>
                    </div>
                    <form action="/anggota/update/{{$detail->id_anggota}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group ">
                                        <label for="id_anggota">Nomor Anggota</label>
                                        <input id="id_anggota" type="id" class="form-control col-sm-4" name="id_anggota" placeholder="Nomor Anggota" value="{{$detail->id_anggota}}" readonly>
                                        @if ($errors->has('id_anggota'))
                                            <span class="text-danger">{{ $errors->first('id_anggota') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input id="name" type="name" class="form-control" name="name" placeholder="Nama lengkap" value="{{$detail->name}}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="tmlahir">Tempat Lahir</label>
                                        <input id="tmlahir" type="text" class="form-control" name="tmlahir" placeholder="Tempat lahir" value="{{$detail->tmlahir}}">
                                        @if ($errors->has('tmlahir'))
                                            <span class="text-danger">{{ $errors->first('tmlahir') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <div class="input-group date" id="reservationdatelahir" data-target-input="nearest">
                                            <input id="tglahir" name="tglahir" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdatelahir" placeholder="Tanggal Lahir" value="{{date('d/m/Y', strtotime($detail->tglahir))}}"/>
                                                @if ($errors->has('tglahir'))
                                                <span class="text-danger">{{ $errors->first('tglahir') }}</span>
                                                @endif
                                            <div class="input-group-append" data-target="#reservationdatelahir" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ktp">No. KTP</label>
                                        <input id="ktp" type="text" class="form-control" name="ktp" placeholder="Nomor KTP/NIK" value="{{$detail->ktp}}">
                                        @if ($errors->has('ktp'))
                                            <span class="text-danger">{{ $errors->first('ktp') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="hp">No. Telp/HP</label>
                                        <input id="hp" type="text" class="form-control" name="hp" placeholder="Nomor handphone" value="{{$detail->hp}}">
                                        @if ($errors->has('hp'))
                                            <span class="text-danger">{{ $errors->first('hp') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input id="alamat" type="text" class="form-control" name="alamat" placeholder="Alamat tempat tinggal" value="{{$detail->alamat}}">
                                        @if ($errors->has('alamat'))
                                            <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img id="preview-image-before-upload" src="{{asset('')}}uploads/avatars/{{$detail->image}}"
                                                alt="preview image" style="max-height: 150px;">
                                            <input type="file" name="file" placeholder="Pilih Foto" id="image" value="{{$detail->image}}">
                                                @error('file')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pendidikan">Pendidikan</label>
                                    <select id="pendidikan" class="form-control" name="pendidikan" value="{{$detail->pendidikan}}">
                                        <option>Tidak Sekolah</option>
                                        <option>SD Sederajat</option>
                                        <option>SMP Sederajat</option>
                                        <option>SMA Sederajat</option>
                                        <option>D1</option>
                                        <option>D2</option>
                                        <option>D3</option>
                                        <option>D4</option>
                                        <option>S1</option>
                                        <option>S2</option>
                                        <option>S3</option>
                                    </select>
                                    @if ($errors->has('pendidikan'))
                                    <span class="text-danger">{{ $errors->first('pendidikan') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <select id="pekerjaan" class="form-control" name="pekerjaan" value="{{$detail->pekerjaan}}">
                                        <option>Buruh Harian Lepas</option>
                                        <option>Petani</option>
                                        <option>Tukang Jahit</option>
                                        <option>Wiraswasta</option>
                                        <option>Lainnya</option>
                                    </select>
                                    @if ($errors->has('pekerjaan'))
                                    <span class="text-danger">{{ $errors->first('pekerjaan') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#reservationdatelahir').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview-image-before-upload').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection