@extends('layouts.app')

@section('title','Dashboard')

@section('content')
  <h1 class="mb-4">Bienvenido al Dashboard</h1>
  <div class="row g-3">
    <div class="col-md-4">
      <div class="card text-white bg-success">
        <div class="card-body">
          <h5 class="card-title">Ingresos Totales</h5>
          <p class="card-text">${{ number_format($totalIn,2) }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-danger">
        <div class="card-body">
          <h5 class="card-title">Gastos Totales</h5>
          <p class="card-text">${{ number_format($totalOut,2) }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white {{ $balance>=0?'bg-primary':'bg-warning' }}">
        <div class="card-body">
          <h5 class="card-title">Balance</h5>
          <p class="card-text">${{ number_format($balance,2) }}</p>
        </div>
      </div>
    </div>
  </div>
@endsection
