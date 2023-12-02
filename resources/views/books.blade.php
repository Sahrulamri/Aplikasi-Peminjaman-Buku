@extends('layouts.mainlayout')

@section('title', 'Books')
@section('content')
  <!-- Main Area Content -->
        <h1>List Books</h1>

        <div class="my-4 d-flex justify-content-end">
            <a href="/books/deleted" class="btn btn-secondary mb-3 me-3">View Deleted Books</a>
            <a href="/books/create" class="btn btn-primary mb-3">Create New Book</a>
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
                DataTable Book
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $item)
                        <tr>
                            <td>{{ $loop-> iteration }}</td>
                            <td>{{ $item->book_code }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @foreach ($item->categories as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </td>
                            <td>{{ $item->status }}</td>
                            <td>
                            <a href="{{ route('books.edit', $item) }}"  class="badge bg-warning text-decoration-none text-white">Edit <span data-feather="edit"></span></a>
                            <form action="{{ route('books.destroy', $item) }}" method="POST" class="d-inline">
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


