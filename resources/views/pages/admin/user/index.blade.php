@extends('pages.admin._layout', [
    'title' => 'Pengguna',
    'menu_active' => 'system',
    'nav_active' => 'user',
])

@section('right-menu')
  <li class="nav-item">
    <a href="{{ url('/admin/user/edit/0') }}" class="btn plus-btn btn-primary mr-2" title="Baru"><i
        class="fa fa-plus"></i></a>
  </li>
@endsection

@section('content')
  <div class="card card-light">
    <div class="card-body">
      <form action="?" method="GET">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group form-inline">
              <label class="mr-2" for="group_id">Grup:</label>
              <select class="form-control custom-select mr-4" name="group_id" id="group_id" onchange="this.form.submit();">
                <option value="">Semua</option>
                @foreach ($groups as $group)
                  <option value="{{ $group->id }}" {{ $filter['group_id'] == $group->id ? 'selected' : '' }}>
                    {{ $group->name }}</option>
                @endforeach
              </select>
              <label class="mr-2" for="type">Jenis Akun:</label>
              <select class="form-control custom-select mr-4" name="type" id="type" onchange="this.form.submit();">
                <option value="-1">Semua</option>
                <option value="1" {{ $filter['type'] == 1 ? 'selected' : '' }}>Administrator</option>
                <option value="0" {{ $filter['type'] == 0 ? 'selected' : '' }}>Pengguna Biasa</option>
              </select>
              <label class="mr-2" for="status">Status:</label>
              <select class="form-control custom-select mr-4" name="status" id="status" onchange="this.form.submit();">
                <option value="-1">Semua</option>
                <option value="1" {{ $filter['status'] == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $filter['status'] == 0 ? 'selected' : '' }}>Tidak Aktif</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 d-flex justify-content-end">
            <div class="form-group form-inline">
              <label class="mr-2" for="search">Cari:</label>
              <input type="text" class="form-control" name="search" id="search" value="{{ $filter['search'] }}"
                placeholder="Cari pengguna">
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
          <table class="table table-bordered table-striped table-sm"
            style="width:100%">
            <thead>
              <tr>
                <th>ID Pengguna</th>
                <th>Nama Lengkap</th>
                <th>Grup</th>
                <th>Status</th>
                <th class="text-center" style="max-width:10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($items as $item)
                <tr>
                  <td>
                    {{ $item->username }}
                    @if ($item->is_admin)
                      <span class="badge badge-warning">Administrator</span>
                    @endif
                  </td>
                  <td>{{ $item->fullname }}</td>
                  <td>{{ $item->group ? $item->group->name : '-' }}</td>
                  <td>{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a href="{{ url("/admin/user/edit/$item->id") }}" class="btn btn-default btn-sm"><i
                          class="fa fa-edit"></i></a>
                      <a href="{{ url("/admin/user/delete/$item->id") }}" class="btn btn-danger btn-sm"><i
                          class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
              @empty
              <tr class="empty">
                  <td colspan="5">Belum ada rekaman</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        </div>
      </div>
      @include('components.paginator', ['items' => $items])
    </div>
  </div>
@endsection
