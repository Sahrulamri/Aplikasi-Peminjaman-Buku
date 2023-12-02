@extends('layouts.mainlayout')

@section('title', 'Categories')
@section('content')
  <!-- Main Area Content -->
        <h1>List Categories</h1>

        <div class="my-4 d-flex justify-content-end">
            <a href="/categories/deleted" class="btn btn-secondary mb-3 me-3">View Deleted Category</a>
            <a href="/categories/create" class="btn btn-primary mb-3">Create New Category</a>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Rent Log
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop-> iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                            <a href="{{ route('categories.edit', $category) }}"  class="badge bg-warning text-decoration-none text-white">Edit <span data-feather="edit"></span></a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Do you want to delete this category?')"> Delete <span data-feather="x-circle"></span></button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection


