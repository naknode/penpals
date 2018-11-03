@extends('layouts.app')

@section('content')
  <h1>{{ $profileUser['username'] }}</h1>
  <p>{{ $profileUser }}</p>
@endsection
