@extends('pages.admin._layout', [
    'title' => 'Kelas',
    'menu_active' => 'master',
    'nav_active' => 'school-grade',
])

@section('right-menu')
  <li class="nav-item">
    <a href="{{ url('/admin/school-grade/edit/0') }}" class="btn plus-btn btn-primary mr-2" title="Baru"><i
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
                  <th>Marhalah</th>
                  <th>Deskripsi</th>
                  <th>No Urut</th>
                  <th class="text-center" style="max-width:10%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($items as $item)
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->priority }}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="{{ url("/admin/school-stage/edit/$item->id") }}" class="btn btn-default btn-sm">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ url("/admin/school-stage/delete/$item->id") }}"
                          onclick="return confirm('Anda yakin akan menghapus rekaman ini?')"
                          class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr class="empty">
                    <td colspan="4">Belum ada rekaman</td>
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
