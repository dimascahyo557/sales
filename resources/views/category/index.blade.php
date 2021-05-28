@extends('layouts.app')

@section('title', 'Category')
@section('content-title', 'Category')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
  <li class="breadcrumb-item active">Category</li>
@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <i class="fas fa-table"></i>
        Category data table
      </div>
      <a href="{{ route('category.create') }}" class="float-right">
        <i class="fas fa-plus"></i>
        Add
      </a>
    </div>
    <div class="card-body">
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

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Category</th>
            <th style="width: 120px">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>{{ $category->category }}</td>
              <td>
                <div class="btn-group">
                  <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-success">
                    <i class="fas fa-pen"></i>
                  </a>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" data-url="{{ route('category.destroy', ['category' => $category->id]) }}">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-3">
        {{ $categories->links() }}
      </div>
    </div>
  </div>

  <x-delete-modal>Are you sure?</x-delete-modal>
@endsection