@extends('layouts.app')

@section('title', 'Detail Product')
@section('content-title', 'Detail Product')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
  <li class="breadcrumb-item active">Detail</li>
@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <i class="fas fa-eye"></i>
        Detail product
      </div>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>ID</th>
          <td>{{ $product->id }}</td>
        </tr>
        <tr>
          <th>Category</th>
          <td>{{ $product->category->category }}</td>
        </tr>
        <tr>
          <th>Name</th>
          <td>{{ $product->name }}</td>
        </tr>
        <tr>
          <th>Price</th>
          <td>{{ $product->price }}</td>
        </tr>
        <tr>
          <th>SKU</th>
          <td>{{ $product->sku }}</td>
        </tr>
        <tr>
          <th>Status</th>
          <td>{{ $product->status }}</td>
        </tr>
        <tr>
          <th>Description</th>
          <td>{{ $product->description }}</td>
        </tr>
        <tr>
          <th>Image</th>
          <td>
            @if ($product->image !== null)
              <img src="{{ Storage::url($product->image) }}" alt="product" style="max-width: 200px">
            @else
              <i>No image</i>
            @endif
          </td>
        </tr>
      </table>
    </div>
    <div class="card-footer">
      <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
  </div>
@endsection