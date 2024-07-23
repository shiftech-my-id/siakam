@extends('pages.admin._layout', [
    'title' => 'Tagihan Santri',
])
@section('content')
  <h1>Tagihan Santri</h1>
  <table>
    <thead>
      <th>No</th>
      <th>Uraian</th>
      <th>Tanggal</th>
      <th>Jatuh Tempo</th>
      <th>Jumlah</th>
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
