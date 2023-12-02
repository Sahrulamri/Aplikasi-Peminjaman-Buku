@extends('layouts.mainlayout')

@section('title', 'Book Return')
@section('content')

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
  <!-- Main Area Content -->
        <h1 class="mb-5 text-center">Book Return Form</h1>

        <div class="col-xl-6 offset-md-3 col-md-8 offset-md-2">
            @if (session()->has('message'))
            <div class="alert {{ session('alert-class') }} alert-dismissible fade show text-center" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        </div>
        

        <form action="/bookReturn" method="post">
            @csrf
            <div class="col-xl-6 offset-md-3 col-md-8 offset-md-2">
                
                <div class="mb-4">
                    <label for="user" class="form-label">User</label>
                    <select class="form-select inputbox" name="user_id" id="user" aria-label="Floating label select example">
                      <option selected>Open this User List</option>
                      @foreach ($users as $item)
                          <option value="{{ $item->id }}">{{ $item->username }}</option>
                      @endforeach
                    </select>
                    
                  </div>
                <div class="mb-4">
                    <label for="book" class="form-label">Book</label>
                    <select class="form-select inputbox" name="book_id" id="book" aria-label="Floating label select example">
                      <option selected>Open this Book List</option>
                      @foreach ($books as $item)
                          <option value="{{ $item->id }}">{{ $item->book_code }} {{ $item->title }}</option>
                      @endforeach
                    </select>
                    
                  </div>
                  <button class="btn btn-primary w-100" type="submit">Submit</button>
            </div>
        </form>
     
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
        $(document).ready(function() {
            $('.inputbox').select2();
        });
       
        </script>
@endsection


