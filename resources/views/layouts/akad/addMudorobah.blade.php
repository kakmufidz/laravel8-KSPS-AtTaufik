@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Mudorobah</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Mudorobah</a></li>
            <li class="breadcrumb-item active">Tambah Mudorobah</li>
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
                        <h3 class="card-title">Data Mudorobah Baru</h3>
                    </div>
                    @if ($detailMudorobah == null)
                        <form action="/akad/mudorobah/tambah" method="post">
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
                                            @if ($errors->has('tglhutang'))
                                            <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                            @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_usaha">Jenis Usaha</label>
                                    <input type="text" class="form-control" name="jenis_usaha" placeholder="Jenis Usaha">
                                    @if ($errors->has('jenis_usaha'))
                                    <span class="text-danger">{{ $errors->first('jenis_usaha') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" placeholder="Jumlah" value="{{old('jumlah')}}">
                                    @if ($errors->has('jumlah'))
                                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group text-bold">
                                    <label for="bagi_hasil">Bagi Hasil</label><br>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control col-md-2" name="bagi_hasil" placeholder="0" value="{{old('bagi_hasil')}}">
                                        <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('bagi_hasil'))
                                    <span class="text-danger">{{ $errors->first('bagi_hasil') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="berakhir">Berakhir Sampai</label>
                                    <input type="text" class="form-control" name="berakhir" placeholder="Berakhir Sampai" value="{{old('berakhir')}}">
                                    @if ($errors->has('berakhir'))
                                    <span class="text-danger">{{ $errors->first('berakhir') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Penanggungjawab</label>
                                    <select name="penanggungjawab" class="select2bs4 select2-hidden-accessible" style="width: 100%;" data-placeholder="Pilih pengurus sebagai penanggungjawab" tabindex="-1" aria-hidden="true">
                                        <option>{{ Auth::user()->name }}</option>
                                        @forelse ($penguruses as $pengurus)
                                            <option>{{$pengurus->name}}</option>
                                        @empty
                                            <option class="bg-danger">Data pengurus belum tersedia</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('penanggungjawab'))
                                        <span class="text-danger">{{ $errors->first('penanggungjawab') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Saksi</label>
                                    <select name="saksi" class="select2bs4 select2-hidden-accessible" style="width: 100%;" data-placeholder="Pilih anggota sebagai saksi" tabindex="-1" aria-hidden="true">
                                        @forelse ($anggotas as $anggota)
                                            <option>
                                                @if ($anggota->id_anggota == $detailAnggota->id_anggota)
                                                @else
                                                    {{$anggota->id_anggota}} {{$anggota->name}}
                                                @endif
                                            </option>
                                        @empty
                                            <option class="bg-danger">Data anggota belum tersedia</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('saksi'))
                                        <span class="text-danger">{{ $errors->first('saksi') }}</span>
                                    @endif
                                </div>
                                {{-- <div class="form-group">
                                    <label>Saksi</label>
                                    <div class="select2-green">
                                        <select name="saksi" class="select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" multiple="" data-placeholder="Pilih anggota sebagai saksi" data-dropdown-css-class="select2-green">
                                            @forelse ($anggotas as $anggota)
                                                <option>
                                                    @if ($anggota->name == $detailAnggota->name)
                                                    @else
                                                     {{$anggota->id_anggota}} {{$anggota->name}}
                                                    @endif
                                                </option>
                                            @empty
                                                <option class="bg-danger">Data anggota belum tersedia</option>
                                            @endforelse
                                        </select>
                                        @if ($errors->has('saksi'))
                                        <span class="text-danger">{{ $errors->first('saksi') }}</span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </div>
                        </form>
                    @elseif ($detailMudorobah->sisa_hutang == 0)
                        <form action="/akad/mudorobah/tambah" method="post">
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
                                            @if ($errors->has('tglhutang'))
                                            <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                            @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_usaha">Jenis Usaha</label>
                                    <input type="text" class="form-control" name="jenis_usaha" placeholder="Jenis Usaha">
                                    @if ($errors->has('jenis_usaha'))
                                    <span class="text-danger">{{ $errors->first('jenis_usaha') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" placeholder="Jumlah" value="{{old('jumlah')}}">
                                    @if ($errors->has('jumlah'))
                                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group text-bold">
                                    <label for="bagi_hasil">Bagi Hasil</label><br>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control col-md-2" name="bagi_hasil" placeholder="0" value="{{old('bagi_hasil')}}">
                                        <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('bagi_hasil'))
                                    <span class="text-danger">{{ $errors->first('bagi_hasil') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="berakhir">Berakhir Sampai</label>
                                    <input type="text" class="form-control" name="berakhir" placeholder="Berakhir Sampai" value="{{old('berakhir')}}">
                                    @if ($errors->has('berakhir'))
                                    <span class="text-danger">{{ $errors->first('berakhir') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Penanggungjawab</label>
                                    <select name="penanggungjawab" class="select2bs4 select2-hidden-accessible" style="width: 100%;" data-placeholder="Pilih pengurus sebagai penanggungjawab" tabindex="-1" aria-hidden="true">
                                        <option>{{ Auth::user()->name }}</option>
                                        @forelse ($penguruses as $pengurus)
                                            <option>{{$pengurus->name}}</option>
                                        @empty
                                            <option class="bg-danger">Data pengurus belum tersedia</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('penanggungjawab'))
                                    <span class="text-danger">{{ $errors->first('penanggungjawab') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Saksi</label>
                                    <select name="saksi" class="select2bs4 select2-hidden-accessible" style="width: 100%;" data-placeholder="Pilih pengurus sebagai penanggungjawab" tabindex="-1" aria-hidden="true">
                                        @forelse ($anggotas as $anggota)
                                            <option>
                                                @if ($anggota->name == $detailAnggota->name)
                                                @else
                                                    {{$anggota->id_anggota}} {{$anggota->name}}
                                                @endif
                                            </option>
                                        @empty
                                            <option class="bg-danger">Data anggota belum tersedia</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('saksi'))
                                    <span class="text-danger">{{ $errors->first('saksi') }}</span>
                                    @endif
                                </div>
                                {{-- <div class="form-group">
                                    <label>Saksi</label>
                                    <div class="select2-green">
                                        <select name="saksi" class="select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" multiple="" data-placeholder="Pilih anggota sebagai saksi" data-dropdown-css-class="select2-green">
                                            @forelse ($anggotas as $anggota)
                                                <option>
                                                    @if ($anggota->name == $detailAnggota->name)
                                                    @else
                                                    {{$anggota->id_anggota}} {{$anggota->name}}
                                                    @endif
                                                </option>
                                            @empty
                                                <option class="bg-danger">Data anggota belum tersedia</option>
                                            @endforelse
                                        </select>
                                        @if ($errors->has('saksi'))
                                        <span class="text-danger">{{ $errors->first('saksi') }}</span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </div>
                        </form>
                    @else
                        <div class="info-box mb-3 bg-danger">
                            <span class="info-box-icon"><i class="fas fa-times"></i></span>
            
                            <div class="info-box-content">
                            <span class="info-box-text">Anda tidak dapat menambahkan mudorobah, karena mudorobah sebelumnya belum Lunas</span>
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
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
</script>
@endsection