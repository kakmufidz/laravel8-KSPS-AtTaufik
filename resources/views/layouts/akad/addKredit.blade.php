@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Kredit</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Kredit</a></li>
            <li class="breadcrumb-item active">Tambah Kredit</li>
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
                            <h3 class="card-title">Data Kredit Baru</h3>
                        </div>
                        @if ($detailKredit == null)
                            <form action="/akad/kredit/tambah" method="post">
                                @csrf
                                <div class="card-body col-sm-6">
                                    <div class="form-group">
                                        <label for="id_anggota">No. Anggota</label>
                                        <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$detailAnggota->id_anggota}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="name" class="form-control" name="name" value="{{$detailAnggota->name}}" readonly>
                                    </div>
                                    <div class="form-group">
                                    <label>Tanggal</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input name="tglhutang" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{old('tglhutang')}}"/>
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('tglhutang'))
                                        <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                    @endif
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text" class="form-control" name="nama_barang" placeholder="Nama barang" value="{{ old('nama_barang') }}">
                                        @if ($errors->has('nama_barang'))
                                        <span class="text-danger">{{ $errors->first('nama_barang') }}</span>
                                        @endif
                                        <p>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control col-md-2" id="jumlah" name="jumlah" placeholder="Jumlah" value="{{old('jumlah')}}">
                                            <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-times"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="{{old('harga')}}">
                                            <span class="input-group-text text-bold">=</span>
                                            <input type="text" class="form-control" id="totalharga" name="total_harga" value="0" readonly>
                                        </div>
                                        @if ($errors->has('jumlah'))
                                            <span class="text-danger">{{ $errors->first('jumlah') }}</span><br>
                                        @endif
                                        @if ($errors->has('harga'))
                                            <span class="text-danger">{{ $errors->first('harga') }}</span><br>
                                        @endif
                                        @if ($errors->has('total_harga'))
                                            <span class="text-danger">{{ $errors->first('total_harga') }}</span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="">Max Angsuran</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="maximal_angsuran" placeholder="0" value="{{old('maximal_angsuran')}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kali</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="">Target Jumlah Angsuran</label>
                                            <div class="input-group ">
                                                <input type="text" class="form-control" name="lama_angsuran" placeholder="0" value="{{old('lama_angsuran')}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kali</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('maximal_angsuran'))
                                        <span class="text-danger">{{ $errors->first('maximal_angsuran') }}</span><br>
                                    @endif
                                    @if ($errors->has('lama_angsuran'))
                                        <span class="text-danger">{{ $errors->first('lama_angsuran') }}</span>
                                    @endif
                                    <div class="form-group">
                                    <label>Jatuh Tempo</label>
                                        <div class="input-group date" id="reservationdatejatuhtempo" data-target-input="nearest">
                                            <input name="jatuh_tempo" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdatejatuhtempo" placeholder="Jatuh Tempo" value="{{old('jatuh_tempo')}}"/>
                                            <div class="input-group-append" data-target="#reservationdatejatuhtempo" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('jatuh_tempo'))
                                        <span class="text-danger">{{ $errors->first('jatuh_tempo') }}</span>
                                    @endif
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
                                    </div>
                                </div>
                                @if (empty($mdata))
                                @else
                                    <input type="hidden" name="prosentase_keuntungankredit" value="{{$mdata->prosentase_keuntungan}}" hidden>
                                    <input type="hidden" name="prosentase_danacadangan" value="{{$mdata->prosentase_danacadangan}}" hidden>
                                    <input type="hidden" name="prosentase_danasosial" value="{{$mdata->prosentase_danasosial}}" hidden>
                                    <input type="hidden" name="prosentase_shupengurus" value="{{$mdata->prosentase_shupengurus}}" hidden>
                                    <input type="hidden" name="prosentase_shuanggota" value="{{$mdata->prosentase_shuanggota}}" hidden>
                                @endif
                                <div class="timeline timeline-inverse ml-4">
                                    <div class="time-label">
                                    <span class="bg-danger">
                                        Penting !!!
                                    </span>
                                    </div>
                                    <div>
                                    <i class="fas fa-user bg-primary"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Peraturan</a> kredit</h3>
                                        @if (empty($mdata))
                                            <div class="timeline-body bg-danger">
                                                Master data belum diatur...<br>
                                            </div>
                                        @else
                                            <div class="timeline-body">
                                                Setiap calon anggota wajib mengikuti peraturan yang disepakati bersama<br>
                                                Keuntungan yang didapatkan adalah <strong>{{$mdata->prosentase_keuntungan}}%</strong><br>
                                                Rincian dana keuntungan nantinya akan dibagi: <br>
                                                1. Dana Cadangan {{$mdata->prosentase_danacadangan}}%<br>
                                                2. Dana S0sial {{$mdata->prosentase_danasosial}}%<br>
                                                3. SHU Pengurus {{$mdata->prosentase_shupengurus}}%<br>
                                                3. SHU Anggota {{$mdata->prosentase_shuanggota}}%<br>
                                            </div>
                                        @endif
                                    </div>
                                    </div>
                                    <div>
                                    <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        @elseif ($detailKredit->sisa_kredit == 0)
                            <form action="/akad/kredit/tambah" method="post">
                                @csrf
                                <div class="card-body col-sm-6">
                                    <div class="form-group">
                                        <label for="id_anggota">No. Anggota</label>
                                        <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$detailAnggota->id_anggota}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="name" class="form-control" name="name" value="{{$detailAnggota->name}}" readonly>
                                    </div>
                                    <div class="form-group">
                                    <label>Tanggal</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input name="tglhutang" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{old('tglhutang')}}"/>
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('tglhutang'))
                                        <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                    @endif
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text" class="form-control" name="nama_barang" placeholder="Nama barang" value="{{ old('nama_barang') }}">
                                        @if ($errors->has('nama_barang'))
                                        <span class="text-danger">{{ $errors->first('nama_barang') }}</span>
                                        @endif
                                        <p>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control col-md-2" id="jumlah" name="jumlah" placeholder="Jumlah" value="{{old('jumlah')}}">
                                            <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-times"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="{{old('harga')}}">
                                            <span class="input-group-text text-bold">=</span>
                                            <input type="text" class="form-control" id="totalharga" name="total_harga" value="0" readonly>
                                        </div>
                                        @if ($errors->has('jumlah'))
                                            <span class="text-danger">{{ $errors->first('jumlah') }}</span><br>
                                        @endif
                                        @if ($errors->has('harga'))
                                            <span class="text-danger">{{ $errors->first('harga') }}</span><br>
                                        @endif
                                        @if ($errors->has('total_harga'))
                                            <span class="text-danger">{{ $errors->first('total_harga') }}</span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="">Max Angsuran</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="maximal_angsuran" placeholder="0" value="{{old('maximal_angsuran')}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kali</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="">Target Jumlah Angsuran</label>
                                            <div class="input-group ">
                                                <input type="text" class="form-control" name="lama_angsuran" placeholder="0" value="{{old('lama_angsuran')}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kali</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('maximal_angsuran'))
                                        <span class="text-danger">{{ $errors->first('maximal_angsuran') }}</span><br>
                                    @endif
                                    @if ($errors->has('lama_angsuran'))
                                        <span class="text-danger">{{ $errors->first('lama_angsuran') }}</span>
                                    @endif
                                    <div class="form-group">
                                    <label>Jatuh Tempo</label>
                                        <div class="input-group date" id="reservationdatejatuhtempo" data-target-input="nearest">
                                            <input name="jatuh_tempo" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdatejatuhtempo" placeholder="Jatuh Tempo" value="{{old('jatuh_tempo')}}"/>
                                            <div class="input-group-append" data-target="#reservationdatejatuhtempo" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('jatuh_tempo'))
                                        <span class="text-danger">{{ $errors->first('jatuh_tempo') }}</span>
                                    @endif
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
                                    </div>
                                </div>
                                @if (empty($mdata))
                                @else
                                    <input type="hidden" name="prosentase_keuntungankredit" value="{{$mdata->prosentase_keuntungan}}" hidden>
                                    <input type="hidden" name="prosentase_danacadangan" value="{{$mdata->prosentase_danacadangan}}" hidden>
                                    <input type="hidden" name="prosentase_danasosial" value="{{$mdata->prosentase_danasosial}}" hidden>
                                    <input type="hidden" name="prosentase_shupengurus" value="{{$mdata->prosentase_shupengurus}}" hidden>
                                    <input type="hidden" name="prosentase_shuanggota" value="{{$mdata->prosentase_shuanggota}}" hidden>
                                @endif
                                <div class="timeline timeline-inverse ml-4">
                                    <div class="time-label">
                                    <span class="bg-danger">
                                        Penting !!!
                                    </span>
                                    </div>
                                    <div>
                                    <i class="fas fa-user bg-primary"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Peraturan</a> kredit</h3>
                                        @if (empty($mdata))
                                            <div class="timeline-body bg-danger">
                                                Master data belum diatur...<br>
                                            </div>
                                        @else
                                            <div class="timeline-body">
                                                Setiap calon anggota wajib mengikuti peraturan yang disepakati bersama<br>
                                                Keuntungan yang didapatkan adalah <strong>{{$mdata->prosentase_keuntungan}}%</strong><br>
                                                Rincian dana keuntungan nantinya akan dibagi: <br>
                                                1. Dana Cadangan {{$mdata->prosentase_danacadangan}}%<br>
                                                2. Dana S0sial {{$mdata->prosentase_danasosial}}%<br>
                                                3. SHU Pengurus {{$mdata->prosentase_shupengurus}}%<br>
                                                3. SHU Anggota {{$mdata->prosentase_shuanggota}}%<br>
                                            </div>
                                        @endif
                                    </div>
                                    </div>
                                    <div>
                                    <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        @else
                            <div class="info-box mb-3 bg-danger">
                                <span class="info-box-icon"><i class="fas fa-times"></i></span>
                
                                <div class="info-box-content">
                                <span class="info-box-text">Anda tidak dapat menambahkan kredit, karena kredit sebelumnya belum Lunas</span>
                                </div>
                            </div>
                        @endif
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
        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#reservationdatejatuhtempo').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $("#jumlah, #harga").keyup(function() {
            var jumlah = $("#jumlah").val();
            var harga = $("#harga").val();
            var totalharga = parseFloat(jumlah) * parseFloat(harga);
            $("#totalharga").val(totalharga);
        });
    });
</script>
@endsection