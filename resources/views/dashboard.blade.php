@extends('layouts.master')
@section('konten')
    <!-- Content Header (Page header) -->
<div class="active tab-pane" id="dashboard">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <form action="/dashboard/daterange" method="post">
    @csrf
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2">
          <div class="form-group">
              <label>Dari Tanggal</label>
              <div class="input-group date" id="reservationdatefrom" data-target-input="nearest">
                  <input name="datefrom" type="text" class="form-control datetimepicker-input" data-target="#reservationdatefrom" value="{{$startDate->format('d/m/Y')}}"/>
                      @if ($errors->has('datefrom'))
                      <span class="text-danger">{{ $errors->first('datefrom') }}</span>
                      @endif
                  <div class="input-group-append" data-target="#reservationdatefrom" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
              <label>Hingga Tanggal</label>
              <div class="input-group date" id="reservationdateto" data-target-input="nearest">
                  <input name="dateto" type="text" class="form-control datetimepicker-input" data-target="#reservationdateto" value="{{$endDate->format('d/m/Y')}}"/>
                      @if ($errors->has('dateto'))
                      <span class="text-danger">{{ $errors->first('dateto') }}</span>
                      @endif
                  <div class="input-group-append" data-target="#reservationdateto" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                  <div class="col-lg-3 ml-2">
                      <button type="submit" class="btn btn-primary">Tampilkan</button>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- Left col -->
        <div class="col-md-6">
            <!-- DANA MASUK -->
            <div class="card">
                <!-- Card-header -->
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Dana Masuk
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="card-body p-0" style="display: block;">
                    <div class="d-md-flex">
                      <div class="p-1 flex-fill" style="overflow: hidden">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3>@currency($totalpemasukan)</h3>
  
                          <p>Total Dana Masuk</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
          <!-- DANA KELUAR -->
          <div class="card">
              <!-- Card-header -->
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Dana Keluar
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card-body p-0" style="display: block;">
                  <div class="d-md-flex">
                    <div class="p-1 flex-fill" style="overflow: hidden">
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3>@currency($totalpengeluaran)</h3>

                        <p>Total Dana Keluar</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                    {{-- <div class="card-pane-right ml-2">
                      <div class="description-block bg-primary p-3">
                        <div class="sparkbar pad" data-color="#fff">Dana Aman</div>
                        <h5 class="description-header" id="daftar">15.000</h5>
                      </div>
                      <!-- /.description-block -->
                      <div class="description-block bg-info p-3">
                        <div class="sparkbar pad" data-color="#fff">Dana Cadangan</div>
                        <h5 class="description-header" id="simpan">560.000</h5>
                      </div>
                      <!-- /.description-block -->
                      <div class="description-block bg-warning p-3">
                        <div class="sparkbar pad" data-color="#fff">Dana Sosial</div>
                        <h5 class="description-header" id="angsur" style="">200.000</h5>
                      </div>
                      <!-- /.description-block -->
                    </div><!-- /.card-pane-right --> --}}
                  </div><!-- /.d-md-flex -->
                </div>
              </div><!-- /.card-body -->
          </div>
          <!-- /.card -->

      </div>
      </div>
    </div>
  </section>
</div>
@endsection
@section('script')
<script type="text/javascript">
    //Date range picker
    $('#reservationdatefrom').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#reservationdateto').datetimepicker({
        format: 'DD/MM/YYYY'
    });
</script>
@endsection