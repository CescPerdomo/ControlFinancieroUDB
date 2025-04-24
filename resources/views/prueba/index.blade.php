@extends('layouts.app')

@section('title', 'Página de Prueba')

@section('content')
  <h1>Contenido de Prueba</h1>
  <ul>
    @foreach($items as $item)
      <li>{{ $item->mensaje }}</li>
    @endforeach
  </ul>
@endsection
