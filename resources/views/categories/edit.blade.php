@extends('layouts.mainlayout')

@section('title', 'Edit Category')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Category</h1>
  </div>
  <div class="col-lg-8">
      <form method="post" action="/categories/{{ $category->slug }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
          {{ session(success) }}
        </div>
        @endif
        <div class="mb-3">
          <label for="name" class="form-label ">Name</label>
          <input type="text" class="form-control @error('name')
          is-invalid
        @enderror" id="name" name="name" required autofocus value="{{ old('name', $category->name) }}">
            @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control  @error('slug')
          is-invalid
      @enderror" id="slug" name="slug" required value="{{ old('slug', $category->slug) }}">
          @error('slug')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary my-4">Update Category</button>
      </form>
  </div>

  <script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
      fetch('/categories/checkSlug?name='+ name.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    });

    
  </script>

@endsection
