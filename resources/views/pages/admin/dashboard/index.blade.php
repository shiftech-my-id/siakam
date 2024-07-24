@extends('pages.admin._layout', [
    'title' => 'Dashboard',
    'nav_active' => 'dashboard',
])

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h1>Selamat Datang, {{ Auth::user()->fullname }}</h1>
              <p>Selamat datang di Aplikasi Sistem Informasi Akademik Madrasah (SIAKAM).</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>0</h4>
              <p>Jumlah Santri Aktif</p>
            </div>
            <div class="icon">
              <i class="fas fa-children"></i>
            </div>
            <a href="/admin/service-order?order_status=0&service_status=-1&payment_status=-1" class="small-box-footer"><i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>0</h4>
              <p>Pengajar Aktif</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="/admin/sales-order?status=0" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4><sup style="font-size: 20px">Rp. </sup>{{ format_number(0) }}</h4>
              <p>Sisa Tagihan Santri</p>
            </div>
            <div class="icon">
              <i class="fa fa-money-bills"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4><sup style="font-size: 20px">Rp. </sup>{{ format_number(0) }}</h4>
              <p>Kas Ma'had</p>
            </div>
            <div class="icon">
              <i class="fa fa-receipt"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h4>0</h4>
              <p>Jumlah Santri Aktif</p>
            </div>
            <div class="icon">
              <i class="fas fa-children"></i>
            </div>
            <a href="/admin/service-order?order_status=0&service_status=-1&payment_status=-1" class="small-box-footer"><i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h4>0</h4>
              <p>Pengajar Aktif</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="/admin/sales-order?status=0" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
