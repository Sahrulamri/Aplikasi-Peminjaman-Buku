@extends('layouts.mainlayout')

@section('title', 'Users')
@section('content')
  <!-- Main Area Content -->
        <h1>List Users</h1>

        <div class="my-4 d-flex justify-content-end">
            <a href="/users/banned" class="btn btn-secondary mb-3 me-3">View Banned User</a>
            <a href="/users/registered" class="btn btn-primary mb-3">New Registered User</a>
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
                DataTable Users
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                            <td>
                              @if ($item->phone)
                                  {{ $item->phone }}
                              @else
                                  -
                              @endif
                            </td>
                            <td>
                            <a href="/users/detail/{{ $item->slug }}"  class="badge bg-warning text-decoration-none text-white">Detail <span data-feather="edit"></span></a>
                            <a href="/users/ban/{{ $item->slug }}"  class="badge bg-danger text-decoration-none text-white" onclick="return confirm('Do you want to ban this user?')">Ban User <span data-feather="x-circle"></span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection


