@extends('layouts.app')

@section('title', 'Product')
@section('content-title', 'Product')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
  <li class="breadcrumb-item active">Product</li>
@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <i class="fas fa-table"></i>
        Products data table
      </div>
      <a href="{{ route('product.create') }}" class="float-right">
        <i class="fas fa-plus"></i>
        Add
      </a>
    </div>
    <div class="card-body overflow-auto">
      {{-- Session success --}}
      @if (session('success'))
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      {{-- Session failed --}}
      @if (session('failed'))
        <div class="alert alert-danger" role="alert">
          {{ session('failed') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      {{-- Search data --}}
        <form action="" method="get">
          <div class="form-group">
            <label for="search">Search</label>
            <input type="search" name="search" class="form-control" value="{{ $search }}" placeholder="Search data" autofocus>
          </div>
        </form>
      {{-- End Search data --}}

      <div class="overflow-auto">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category</th>
              <th>Name</th>
              <th>Price</th>
              <th>SKU</th>
              <th>Image</th>
              <th>Status</th>
              <th style="width: 200px">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category->category }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ "Rp " . number_format($product->price, 2, ',', '.') }}</td>
                <td>{{ $product->sku }}</td>
                <td>
                  @if ($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="product" width="100px">
                  @else
                    <i>No image</i>
                  @endif
                </td>
                <td>{{ $product->status }}</td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('product.show', ['product' => $product->id]) }}" class="btn btn-info">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-success">
                      <i class="fas fa-pen"></i>
                    </a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" data-url="{{ route('product.destroy', ['product' => $product->id]) }}">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-toggle2="tooltip" title="force delete" data-target="#delete-modal" data-url="{{ route('product.force-delete', ['product' => $product->id]) }}">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="mt-3">
        {{ $products->links() }}
      </div>
    </div>
  </div>

  <x-delete-modal>Are you sure?</x-delete-modal>
@endsection
@section('script')
  <script>
    $(function () {
      $('[data-toggle2="tooltip"]').tooltip({
        delay: {
          show: 500,
          hide: 100
        },
        placement: "bottom"
      })
    })
  </script>
@endsection