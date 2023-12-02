@extends('layouts.mainlayout')

@section('title', 'Users')
@section('content')
  <!-- Main Area Content -->
    <h1>Detail User</h1>

        <div class="my-4 d-flex justify-content-end">
            @if ($user->status == 'inactive')
            <a href="/users/approve/{{ $user->slug }}" class="btn btn-primary mb-3 me-3">Approve User</a>
            <a href="/users" class="btn btn-info mb-3 me-3">Back</a>
            <a href="/users/registered" class="btn btn-warning mb-3">Back To New Regiter User</a>
            @else
            <a href="/users" class="btn btn-info mb-3 me-4">Back</a>
            <a href="/users/registered" class="btn btn-warning mb-3">Back To New Regiter User</a>
            @endif
            {{-- <a href="/categories/deleted" class="btn btn-secondary mb-3 me-3">View Banned User</a> --}}
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            
            <div class="row">
                <div class="col-xl-5">
                    <div class="d-flex">
                        <i class="bi bi-person-fill fs-2 me-3"></i><h2>User Profile</h2>
                    </div>
                    <div class="card mb-4">
                        <div class="form-group mb-4 mx-3">
                            <label for="username" class="mb-2">Username :</label>
                            <input type="text" class="form-control" id="username" readonly value="{{ $user->username }}">
                        </div>
                        <div class="form-group mb-4 mx-3">
                            <label for="phone" class="mb-2">Phone :</label>
                            <input type="text" class="form-control text-left d-flex" id="phone" readonly value="{{ $user->phone }}">
                            
                        </div>
                        <div class="form-group mb-4 mx-3">
                            <label for="address" class="mb-2">Address :</label>
                            <input type="text" class="form-control" id="address" readonly value="{{ $user->address }}">
                        </div>
                        <div class="form-group mb-4 mx-3">
                            <label for="status" class="mb-2">Status :</label>
                            <input type="text" class="form-control" id="status" readonly value="{{ $user->status }}">
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-7">
                    <div class="d-flex">
                        <i class="bi bi-clock-history fs-3 me-3"></i><h2>User Rent Log</h2>
                    </div>
                   <div class="card mb-4">
                       <x-rent-log-table :rentlog='$rent_logs'/>
                   </div>
                </div>
            
            </div>
      
@endsection


