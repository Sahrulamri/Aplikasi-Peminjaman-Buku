@extends('layouts.mainlayout')

@section('title', 'Add Category')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Book</h1>
  </div>
  <div class="col-lg-8">
      <form method="post" action="/books" enctype="multipart/form-data">
        @csrf
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
          {{ session(success) }}
        </div>
        @endif
        <div class="mb-3">
          <label for="code" class="form-label ">Code</label>
          <input type="text" class="form-control @error('title')
          is-invalid
        @enderror" id="code" name="book_code" required autofocus value="{{ old('book_code') }}">
            @error('book_code')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="title" class="form-label ">Title</label>
          <input type="text" class="form-control @error('title')
          is-invalid
        @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control  @error('slug')
          is-invalid
      @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
          @error('slug')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
          <label for="image" class="form-label">Post An Image</label>
          <img class="img-preview img-fluid mb-3 col-sm-5">
          <input class="form-control @error('image')
          is-invalid
      @enderror" type="file" id="image" name="image" onchange="previewImage()">
      @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
        </div>

        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select name="categories[]" id="category" class="form-control select-multiple" multiple>
            @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary my-4">Create Post</button>
      </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
      fetch('/books/checkSlug?title='+ title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    });
    function previewImage() {
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
    
    $(document).ready(function() {
    $('.select-multiple').select2();
    });
  </script>

@endsection
