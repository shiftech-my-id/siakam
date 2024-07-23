@extends('pages.public._layout')
@section('content')
  <h1>Masuk</h1>
  <form action="?" method="post">
    @csrf
    <p><label for="">ID Pengguna: <input type="text"></label></p>
    <p><label for="">Kata Sandi: <input type="password"></label></p>
    <p><input type="submit" value="Masuk"></p>
  </form>
@endsection
