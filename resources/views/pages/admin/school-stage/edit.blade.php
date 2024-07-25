@php
  $title = ($item->id ? 'Edit' : 'Tambah') . ' Marhalah';
@endphp

@extends('pages.admin._layout', [
    'title' => $title,
    'menu_active' => 'master',
    'nav_active' => 'school-stage',
])

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <form action="?" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <div class="form-group">
              <label for="name">Nama Marhalah</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus id="name"
                placeholder="Masukkan nama Marhalah" name="name" value="{{ old('name', $item->name) }}">
              @error('name')
                <span class="text-danger">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <input type="text" class="form-control" id="description" placeholder="Deskripsi marhalah"
                name="description" value="{{ old('description', $item->description) }}">
            </div>
            <div class="form-group">
              <label for="priority">No Urut</label>
              <input type="number" min="1" max="10" class="form-control" id="priority" placeholder="No Urut" name="priority"
                value="{{ old('priority', $item->priority) }}">
            </div>
            <div class="mt-4">
              <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-check mr-1"></i> Simpan</button>
              <a onclick="return confirm('Batalkan perubahan?')" class="btn btn-default"
                href="{{ url('/admin/school-stage/') }}"><i class="fas fa-xmark mr-1"></i>Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endSection
