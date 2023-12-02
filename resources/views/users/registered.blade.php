@extends('layouts.mainlayout')

@section('title', 'Users')
@section('content')
  <!-- Main Area Content -->
        <h1>List Registered Users</h1>

        <div class="my-4 d-flex justify-content-end">
            {{-- <a href="/categories/deleted" class="btn btn-secondary mb-3 me-3">View Banned User</a> --}}
            
            <a href="/users" class="btn btn-primary mb-3">Approved User List</a>
            
            
            {{-- <a href="/users/approve/{{ $user->slug }}" class="btn btn-primary mb-3">Approve User</a> --}}
            
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
                        @foreach ($registeredUsers as $item)
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection


