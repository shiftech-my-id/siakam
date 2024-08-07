@extends('pages.admin._layout', [
    'title' => 'Siswa',
    'menu_active' => 'master',
    'nav_active' => 'student',
])

@section('right-menu')
  <li class="nav-item">
    <a href="{{ url('/admin/student/edit/0') }}" class="btn plus-btn btn-primary mr-2" title="Baru"><i
        class="fa fa-plus"></i></a>
  </li>
@endsection

@section('content')
  <div class="card card-light">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" style="width:100%">
              <thead>
                <tr>
                  <th>NISN</th>
                  <th>Nama Lengkap</th>
                  <th>Marhalah</th>
                  <th>Kelas</th>
                  <th>L/P</th>
                  <th>Status</th>
                  <th class="text-center" style="max-width:10%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($items as $item)
                  <tr>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->fullname }}</td>
                    <td>{{ $item->stage ? $item->stage->name : '' }}</td>
                    <td>{{ $item->grade ? $item->grade->name : '' }}</td>
                    <td>{{ $item->gender == 'male' ? 'L' : 'P' }}</td>
                    <td>{{ $item->active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="{{ url("/admin/student/edit/$item->id") }}" class="btn btn-default btn-sm"><i
                            class="fa fa-edit"></i></a>
                        <a href="{{ url("/admin/student/delete/$item->id") }}" class="btn btn-danger btn-sm"><i
                            class="fa fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr class="empty">
                    <td colspan="7">Belum ada rekaman</td>
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
