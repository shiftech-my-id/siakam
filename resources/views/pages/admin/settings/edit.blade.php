@php
  use App\Models\Setting;
@endphp

@extends('pages.admin._layout', [
    'title' => 'Pengaturan',
    'menu_active' => 'system',
    'nav_active' => 'settings',
    'form_action' => url('admin/settings/save'),
])

@section('right-menu')
  <li class="nav-item">
    <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-save mr-1"></i> Simpan</button>
  </li>
@endSection

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="card card-light">
        <div class="card-header" style="padding:0;border-bottom:0;">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="school-profile-tab" data-toggle="tab" href="#school-profile" role="tab"
                aria-controls="school-profile" aria-selected="false">Profil Ma'had</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" id="inventory-tab" data-toggle="tab" href="#inventory" role="tab"
                aria-controls="inventory" aria-selected="true">Inventori</a>
            </li> --}}
          </ul>
        </div>
        <div class="tab-content card-body" id="myTabContent">
          {{-- <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
            <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="inv-show-desc" name="inv_show_description"
                  {{ Setting::value('inv.show_description') ? 'checked' : '' }}>
                <label class="custom-control-label" for="inv-show-desc">Tampilkan deskripsi produk</label>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="inv-show-barcode" name="inv_show_barcode"
                  {{ Setting::value('inv.show_barcode') ? 'checked' : '' }}>
                <label class="custom-control-label" for="inv-show-barcode">Tampilkan barcode produk</label>
              </div>
            </div>
          </div> --}}
          <div class="tab-pane fade show active" id="school-profile" role="tabpanel"
            aria-labelledby="school-profile-tab">
            <div class="form-horizontal">
              <div class="form-group">
                <label for="school_name">Nama Ma'had</label>
                <input type="text" class="form-control @error('school_name') is-invalid @enderror" id="school_name"
                  placeholder="Nama Usaha" name="school_name" value="{{ Setting::value('school.name', 'Ma\'had ...') }}">
                @error('school_name')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="school_headline">Tagline</label>
                <input type="text" class="form-control @error('school_headline') is-invalid @enderror"
                  id="school_headline" placeholder="..."
                  name="school_headline" value="{{ Setting::value('school.headline', '') }}">
                @error('school_headline')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              {{-- <div class="form-group">
                <label for="school_owner">Nama Pemilik</label>
                <input type="text" class="form-control @error('school_owner') is-invalid @enderror" id="school_owner"
                  placeholder="Nama Pemilik" name="school_owner" value="{{ Setting::value('school.owner') }}">
                @error('school_owner')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div> --}}
              <div class="form-group">
                <label for="school_phone">No. Telepon</label>
                <input type="text" class="form-control @error('school_phone') is-invalid @enderror" id="school_phone"
                  placeholder="Nomor Telepon / HP" name="school_phone" value="{{ Setting::value('school.phone') }}">
                @error('school_phone')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="school_website">Website</label>
                <input type="text" class="form-control @error('school_website') is-invalid @enderror"
                  id="school_website" placeholder="www.namamadrasah.sch.id" name="school_website"
                  value="{{ Setting::value('school.website') }}">
                @error('school_website')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="school_address">Alamat</label>
                <textarea class="form-control" id="school_address" name="school_address">{{ Setting::value('school.address') }}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection
