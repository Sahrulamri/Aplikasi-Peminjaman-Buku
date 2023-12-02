@extends('layouts.mainlayout')

@section('title', 'Profile')
@section('content')
<!-- Main Area Content -->
<h1 class="text-center mb-5">Your Rent Log's</h1>
  <div class="row">
    <div class="col-xl-5">
      <div class="d-flex">
        <i class="bi bi-person-fill fs-2 me-3"></i><h3>Your Profile</h3>
    </div>
      <div class="card mb-4">
        <div class="form-group mb-4 mx-3">
            <label for="username" class="mb-2">Username :</label>
            <input type="text" class="form-control" id="username" readonly value="{{ auth()->user()->username }}">
        </div>
        <div class="form-group mb-4 mx-3">
            <label for="phone" class="mb-2">Phone :</label>
            <input type="text" class="form-control text-left d-flex" id="phone" readonly value="{{ (auth()->user()->phone) ? auth()->user()->phone : 'No Phone' }}">
            
        </div>
        <div class="form-group mb-4 mx-3">
            <label for="address" class="mb-2">Address :</label>
            <input type="text" class="form-control" id="address" readonly value="{{  auth()->user()->address }}">
        </div>
        <div class="form-group mb-4 mx-3">
            <label for="status" class="mb-2">Status :</label>
            <input type="text" class="form-control" id="status" readonly value="{{  auth()->user()->status }}">
        </div>
    </div>
    </div>
    <div class="col-xl-7">
      <div class="d-flex">
          <i class="bi bi-hourglass-split fs-3 me-3"></i><h3>Your Rent Log History</h3>
      </div>
     <div class="card mb-4">
         <x-rent-log-table :rentlog='$rent_logs'/>
     </div>
  </div>
  </div>
@endsection