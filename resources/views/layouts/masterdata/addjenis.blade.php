@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Jenis Simpanan</h1>
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
                            <form action="/jsimpanan/tambah/" method="POST">
                              @csrf
                              <div class="form-group">
                                  <label for="jenis_dana">Jenis Dana</label>
                                  <select id="jenis_dana" class="form-control" name="jenis_dana" value="{{old('jenis_dana')}}">
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
                                <input type="text" class="form-control" name="new_simpanan" placeholder="Jenis simpanan baru" value="{{old('new_simpanan')}}">
                                  @if ($errors->has('new_simpanan'))
                                  <span class="text-danger">{{ $errors->first('new_simpanan') }}</span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label for="minimal">Minimal Nominal</label>
                                  <input type="text" class="form-control" name="minimal" placeholder="Minimal" value="{{old('minimal')}}">
                                    @if ($errors->has('minimal'))
                                    <span class="text-danger">{{ $errors->first('minimal') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                  <label for="maksimal">Maksimal Nominal</label>
                                  <input type="text" class="form-control" name="maksimal" placeholder="Maksimal" value="{{old('maksimal')}}">
                                    @if ($errors->has('maksimal'))
                                    <span class="text-danger">{{ $errors->first('maksimal') }}</span>
                                    @endif
                                </div>
                                {{-- <div class="form-group">
                                    <label for="minimal">Minimal Nominal</label>
                                    <select class="form-control" name="minimal" onchange="minimalon(this)" value="{{old('minimal')}}">
                                        <option>Tidak ditentukan</option>
                                        <option>@currency(5000)</option>
                                        <option>@currency(10000)</option>
                                        <option>@currency(20000)</option>
                                        <option>@currency(30000)</option>
                                        <option>@currency(40000)</option>
                                        <option>@currency(50000)</option>
                                        <option>Nominal lain</option>
                                    </select>
                                    <input type="text" style="display:none" class="form-control mt-3" name="minimallain" id="minimal">
                                    @if ($errors->has('minimal'))
                                    <span class="text-danger">{{ $errors->first('minimal') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="maksimal">Maksimal Nominal</label>
                                    <select class="form-control" name="maksimal" onchange="maksimalon(this)" value="{{old('maksimal')}}">
                                        <option>Tidak ditentukan</option>
                                        <option>@currency(5000)</option>
                                        <option>@currency(10000)</option>
                                        <option>@currency(20000)</option>
                                        <option>@currency(30000)</option>
                                        <option>@currency(40000)</option>
                                        <option>@currency(50000)</option>
                                        <option>Nominal lain</option>
                                    </select>
                                    <input type="text" style="display:none" class="form-control mt-3" name="maksimallain" id="maksimal">
                                    @if ($errors->has('maksimal'))
                                    <span class="text-danger">{{ $errors->first('maksimal') }}</span>
                                    @endif
                                </div> --}}
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
@section('script')
{{-- <script>
  function hideminimal()
  {
      var a=document.getElementById('minimal');
      a.style.visibility='hidden';
  }
  function showminimal()
  {
      var a=document.getElementById('minimal');
      a.style.visibility='visible';
  }
  function minimalon(select) {
      if(select.value=='Nominal lain'){
          showminimal();
      }else{
          hideminimal();
      }
  }
  function hidemaksimal()
  {
      var b=document.getElementById('maksimal');
      b.style.display='none';
  }
  function showmaksimal()
  {
      var b=document.getElementById('maksimal');
      b.style.display='block';
  }
  function maksimalon(select) {
      if(select.value=='Nominal lain'){
          showmaksimal();
      }else{
          hidemaksimal();
      }
  }
</script> --}}
@endsection