@extends('layouts.app')

@section('content')

  @if (session('message'))
  <div class="alert alert-success" role="alert">
      {{ Session::get('message') }}
  </div>
  @endif

  <div>Welcome.</div>

@endsection