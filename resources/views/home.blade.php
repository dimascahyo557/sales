@extends('layouts.app')

@section('title', 'Dashboard')
@section('content-title', 'Dashboard')
@section('breadcrumb')
  <li class="breadcrumb-item active">Home</li>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          You are logged in!
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
