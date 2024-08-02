@php
  $title = ($item->id ? 'Edit' : 'Tambah') . ' Kelas';
@endphp

@extends('pages.admin._layout', [
    'title' => $title,
    'menu_active' => 'master',
    'nav_active' => 'school-grade',
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
                <label for="stage_id">Marhalah</label>
                <select class="custom-select select2 @error('stage_id') is-invalid @enderror" id="stage_id" name="stage_id">
                  <option value="" {{ !$item->stage_id ? 'selected' : '' }}>-- Pilih Marhalah --</option>
                  @foreach ($stages as $stage)
                    <option value="{{ $stage->id }}" {{ old('stage_id', $item->stage_id) == $stage->id ? 'selected' : '' }}>
                      {{ $stage->name }}
                    </option>
                  @endforeach
                </select>
                @error('stage_id')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group">
              <label for="name">Nama Kelas</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus id="name"
                placeholder="Masukkan nama Kelas" name="name" value="{{ old('name', $item->name) }}">
              @error('name')
                <span class="text-danger">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <input type="text" class="form-control" id="description" placeholder="Deskripsi kelas"
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
