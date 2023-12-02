@extends('layouts.mainlayout')

@section('title', 'Rent Logs')
@section('content')
  <!-- Main Area Content -->
        <h1>Rent Log List</h1>
        <div class="card mb-4">
          <div class="card-header">
              <i class="fas fa-table me-1"></i>
              DataTable Rent Log
          </div>
          <div class="card-body">
              <x-rent-log-table :rentlog='$rent_logs'/>
          </div>
      </div>
@endsection


