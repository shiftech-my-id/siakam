@extends('pages.admin._layout', [
    'title' => 'Santri',
])
@section('content')
  <h1>Santri</h1>
  <table>
    <thead>
      <th>No Induk</th>
      <th>Nama Lengkap</th>
      <th>Marhalah</th>
      <th>Kelas</th>
      <th>Jenis Kelamin</th>
      <th>Aksi</th>
    </thead>
    <tbody>
      @forelse($items as $item)
      @empty
        <tr>
          <td colspan="3">Belum ada rekaman</td>
        </tr>
      @endforelse
    </tbody>
  </table>
@endsection
