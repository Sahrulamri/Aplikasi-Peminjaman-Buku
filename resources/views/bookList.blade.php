@extends('layouts.mainlayout')

@section('title', 'Books')
@section('content')
  <!-- Main Area Content -->
        <div class="my-5">
          <form action="" method="get">
          <div class="row d-flex justify-content-center mb-3">
            <div class="col-xl-8 ">
              <div class="input-group mb-4">
                <div class="col-xl-3">
                  <select class="form-select text-center" name="category" id="category" style="border-radius: 0;">
                    <option selected>Category</option>
                    @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <input type="text" name="title" class="form-control" placeholder="Search Book Here..." for="search">
                <button class="btn btn-outline-secondary" type="submit" id="search">Button</button>
              </div>
            </div>
          </div>
          </form>

            <div class="row">
              @if ($books->count())
                @foreach ($books as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-3 mx-auto">
                    <div class="card h-100">
                        <img src="{{ $item->cover ? asset('storage/cover/'. $item->cover) : asset('images/cover.jpg')  }}" class="card-img-top mx-auto mt-3" style="width: 150px;" draggable="false">
                        <div class="card-body">
                            <p class="text-muted fs-5">{{ $item->book_code }}</p>
                          <h5 class="card-title fs-4">{{ $item->title }}</h5>
                          <p class="btn {{ $item->status == 'in stock' ? 'btn-success' : 'btn-danger' }} float-end fw-bold">{{ $item->status }}</p>
                        </div>
                      </div>
                </div>
                @endforeach
                @else
                <div class="d-flex align-items-center justify-content-center vh-100">
                  <div>
                    <h1 class="text-center">Sorry...</h1>
                    <h1 class="text-center">The Book's Not Found</h1>
                </div>
                </div>
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-center mx-3 my-5">
          <div class="d-inline-block justify-content-center me-3">
            {{ $books->links() }}
          </div>
      </div>
@endsection


