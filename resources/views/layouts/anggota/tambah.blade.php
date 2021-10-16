@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Anggota</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Anggota</a></li>
            <li class="breadcrumb-item active">Tambah Anggota</li>
          </ol>
        </div>
      </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Anggota Baru</h3>
                        </div>
                        <form action="/anggota/tambah" method="POST" id="regForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-body">
                                        <div class="form-group ">
                                            <label>Tanggal Daftar</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input name="tgldaftar" id="tgldaftar" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal Daftar" value="{{old('tgldaftar')}}"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @if ($errors->has('tgldaftar'))
                                                <span class="text-danger">{{ $errors->first('tgldaftar') }}</span>
                                                @endif
                                            </div>
                                            @if (empty($anggota))
                                                <label for="id_anggota">Nomor Anggota</label>
                                                <input id="id_anggota" type="id" class="form-control col-sm-4" name="id_anggota" placeholder="Nomor Anggota" value="0001" readonly>
                                                @if ($errors->has('id_anggota'))
                                                    <span class="text-danger">{{ $errors->first('id_anggota') }}</span>
                                                @endif
                                            @else
                                                @php 
                                                    $no=$anggota->id_anggota+1;
                                                    $urut = sprintf("%04s",$no++);
                                                @endphp
                                                <label for="id_anggota">Nomor Anggota</label>
                                                <input id="id_anggota" type="id" class="form-control col-sm-4" name="id_anggota" placeholder="Nomor Anggota" value="{{$urut}}" readonly>
                                                @if ($errors->has('id_anggota'))
                                                    <span class="text-danger">{{ $errors->first('id_anggota') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nama Lengkap</label>
                                            <input id="name" type="name" class="form-control" name="name" placeholder="Nama lengkap" value="{{old('name')}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="tmlahir">Tempat Lahir</label>
                                            <input id="tmlahir" type="text" class="form-control" name="tmlahir" placeholder="Tempat lahir" value="{{old('tmlahir')}}">
                                            @if ($errors->has('tmlahir'))
                                                <span class="text-danger">{{ $errors->first('tmlahir') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <div class="input-group date" id="reservationdatelahir" data-target-input="nearest">
                                                <input id="tglahir" name="tglahir" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdatelahir" placeholder="Tanggal Lahir" value="{{old('tglahir')}}"/>
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
                                            <input id="ktp" type="text" class="form-control" name="ktp" placeholder="Nomor KTP/NIK" value="{{old('ktp')}}">
                                            @if ($errors->has('ktp'))
                                                <span class="text-danger">{{ $errors->first('ktp') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="hp">No. Telp/HP</label>
                                            <input id="hp" type="text" class="form-control" name="hp" placeholder="Nomor handphone" value="{{old('hp')}}">
                                            @if ($errors->has('hp'))
                                                <span class="text-danger">{{ $errors->first('hp') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input id="alamat" type="text" class="form-control" name="alamat" placeholder="Alamat tempat tinggal" value="{{old('alamat')}}">
                                            @if ($errors->has('alamat'))
                                                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <img id="preview-image-before-upload" src="{{asset('')}}assets/dist/img/no_image.jpg"
                                                    alt="preview image" style="max-height: 150px;">
                                                <input type="file" name="file" placeholder="Pilih Foto" id="image" value="{{old('file')}}">
                                                  @error('file')
                                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                  @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pendidikan">Pendidikan</label>
                                        <select id="pendidikan" class="form-control" name="pendidikan" value="{{old('pendidikan')}}">
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
                                        <select class="form-control" name="pekerjaan" onchange="apa(this)" value="{{old('pekerjaan')}}">
                                            <option>Buruh Harian Lepas</option>
                                            <option>Petani</option>
                                            <option>Tukang Jahit</option>
                                            <option>Wiraswasta</option>
                                            <option>Lainnya</option>
                                        </select>
                                        <input type="text" style="visibility:hidden" class="form-control mt-3" name="pekerjaanlain" id="pekerjaan">
                                        @if ($errors->has('pekerjaan'))
                                        <span class="text-danger">{{ $errors->first('pekerjaan') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="registrasi">Uang Registrasi</label>
                                        @if (empty($minregistrasi))
                                            <input id="registrasi" type="text" class="form-control bg-danger" name="registrasi" placeholder="Uang Registrasi" value="Jenis simpanan ini belum ada" readonly>
                                        @else
                                            <input id="registrasi" type="text" class="form-control" name="registrasi" placeholder="Uang Registrasi" value="{{$minregistrasi}}" readonly>
                                        @endif
                                        @if ($errors->has('registrasi'))
                                            <span class="text-danger">{{ $errors->first('registrasi') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="s_pokok">Simpanan Pokok Awal</label>
                                        @if (empty($mins_pokok))
                                            <input id="s_pokok" type="text" class="form-control bg-danger" name="s_pokok" placeholder="Simpanan Pokok" value="Jenis simpanan ini belum ada" readonly>
                                        @else
                                            <input id="s_pokok" type="text" class="form-control" name="s_pokok" placeholder="Simpanan Pokok" value="{{$mins_pokok}}" readonly>
                                        @endif
                                        @if ($errors->has('s_pokok'))
                                            <span class="text-danger">{{ $errors->first('s_wajib') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="s_wajib">Simpanan Wajib Awal</label>
                                        @if (empty($mins_wajib))
                                            <input type="text" id="s_wajib" class="form-control bg-danger" name="s_wajib" placeholder="Simpanan Wajib" value="Jenis simpanan ini belum ada" readonly>
                                        @else
                                            <input type="text" id="s_wajib" class="form-control" name="s_wajib" placeholder="Simpanan Wajib" value="{{$mins_wajib}}">
                                        @endif
                                        @if ($errors->has('s_wajib'))
                                            <span class="text-danger">{{ $errors->first('s_wajib') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="timeline timeline-inverse ml-4">
                                <!-- timeline time label -->
                                <div class="time-label">
                                  <span class="bg-danger">
                                    Penting !!!
                                  </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                  <i class="fas fa-user bg-primary"></i>
          
                                  <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">Peraturan</a> pendaftaran anggota baru</h3>
                                    @if (empty($minregistrasi))
                                        <div class="timeline-body bg-danger">
                                            Jenis simpanan Registrasi belum ada<br>
                                        </div>
                                    @elseif (empty($mins_pokok))
                                        <div class="timeline-body bg-danger">
                                            Jenis simpanan Simpanan Pokok belum ada<br>
                                        </div>
                                    @elseif (empty($mins_wajib))
                                        <div class="timeline-body bg-danger">
                                            Jenis simpanan Simpanan Wajib belum ada<br>
                                        </div>
                                    @else
                                        <div class="timeline-body">
                                            Setiap calon anggota wajib mengisi form pendaftaran yang disediakan koperasi <br>
                                            Calon anggota membayar setoran awal sebesar <strong>Rp @currency($totalmdata)</strong><br>
                                            Dengan Rincian: <br>
                                            1. Registrasi = Rp @currency($minregistrasi)<br>
                                            2. Simpanan Pokok = Rp @currency($mins_pokok)<br>
                                            3. Simpanan Wajib = Rp @currency($mins_wajib)<br>
                                        </div>
                                    @endif
                                  </div>
                                </div>
                                <div>
                                  <i class="far fa-clock bg-gray"></i>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@if (empty($mins_wajib))
@else
    <input type="hidden" name="sim_wajib" id="sim_wajib" value="{{$mins_wajib}}" hidden>
@endif
@endsection
@section('script')
<script>
    function hide()
    {
        var a=document.getElementById('pekerjaan');
        a.style.visibility='hidden';
    }
    function tampil()
    {
        var a=document.getElementById('pekerjaan');
        a.style.visibility='visible';
    }
    function apa(select) {
        if(select.value=='Lainnya'){
            tampil();
        }else{
            hide();
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#reservationdatelahir').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $("#sim_wajib").ready(function () {
            var sim_wajib = $("#sim_wajib").val();
            $("#regForm").validate({
                rules: {
                    s_wajib: {
                        required: true,
                        min: parseInt(sim_wajib)
                    }
                }
            });
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