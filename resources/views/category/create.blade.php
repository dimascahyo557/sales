@extends('layouts.app')

@section('title', 'Add Category')
@section('content-title', 'Add Category')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
  <li class="breadcrumb-item active">Add</li>
@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <i class="fas fa-plus"></i>
        Add category
      </div>
    </div>
    <form action="{{ route('category.store') }}" method="post">
      @csrf
      <div class="card-body">
        <div class="form-group mb-0">
          <label for="category">Category</label>
          <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" placeholder="Category name" value="{{ old('category') }}" id="category">
          @error('category')
            <small class="invalid-feedback">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('category.index') }}" class="btn btn-outline-secondary">Back</a>
        <button type="submit" class="btn btn-primary float-right">Add Category</button>
      </div>
    </form>
  </div>
@endsection