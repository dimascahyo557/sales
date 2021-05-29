@extends('layouts.app')

@section('title', 'Add Product')
@section('content-title', 'Add Product')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
  <li class="breadcrumb-item active">Add</li>
@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <i class="fas fa-plus"></i>
        Add product
      </div>
    </div>
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="category">Category</label>
              <select name="category" class="form-control @error('category') is-invalid @enderror" id="category">
                <option value="">Choose category</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->category }}</option>
                @endforeach
              </select>
              @error('category')
                <small class="invalid-feedback">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" value="{{ old('name') }}" id="name">
              @error('name')
              <small class="invalid-feedback">{{ $message }}</small>
              @enderror
            </div>
            
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price" value="{{ old('price') }}" id="price">
              @error('price')
                <small class="invalid-feedback">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="sku">SKU</label>
              <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" placeholder="Enter sku" value="{{ old('sku') }}" id="sku">
              @error('sku')
                <small class="invalid-feedback">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                <option value="1" @if(old('status') == true && old('status') != null) selected @endif>Active</option>
                <option value="0" @if(old('status') == false && old('status') != null) selected @endif>Inactive</option>
              </select>
              @error('status')
                <small class="invalid-feedback">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label for="image">Image</label>
              <input name="image" type="file" class="form-control-file form-control @error('image') is-invalid @enderror" id="image">
              @error('image')
                <small class="invalid-feedback">{{ $message }}</small>
              @enderror
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="description">Description</label>
              <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter description" rows="3" id="description">{{ old('description') }}</textarea>
              @error('description')
                <small class="invalid-feedback">{{ $message }}</small>
              @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Back</a>
        <button type="submit" class="btn btn-primary float-right">Add Product</button>
      </div>
    </form>
  </div>
@endsection