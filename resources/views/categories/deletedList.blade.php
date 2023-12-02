@extends('layouts.mainlayout')

@section('title', 'Deleted Category')
@section('content')
  <!-- Main Area Content -->
        <h1>Deleted List Categories</h1>

        <div class="my-4 d-flex justify-content-end">
            <a href="/categories" class="btn btn-primary mb-3">Back</a>
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
                        @foreach ($deletedCategories as $category)
                        <tr>
                            <td>{{ $loop-> iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                            <a href="/categories/restore/{{ $category->slug }}"  class="badge bg-success text-decoration-none text-white">Restore <span data-feather="edit"></span></a>
     
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection


