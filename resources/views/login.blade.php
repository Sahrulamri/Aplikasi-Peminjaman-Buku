<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Rental Buku | Login</title>
  </head>
  <body>

   
<main class="form-signin">
    @if (session('status'))
    <div class="alert alert-danger alert-dismissible fade show text-center mt-3 mx-4" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
<section class="vh-100">
  <h1 class="text-center">
    Form Login
  </h1>
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form action="/login" method="post">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
              <label for="username">Username</label>
              <input type="text" class="form-control @error('username')
                  is-invalid
              @enderror" id="username" name="username" value="{{ old('username') }}" autocomplete="off" autofocus required>
              @error('username')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
  
            <!-- Password input -->
            <div class="form-outline mb-4">
              <label for="password">Password</label>
                    <input type="password" class="form-control @error('password')
                        is-invalid
                    @enderror" id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
  
            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <a href="#!">Forgot password?</a>
              <p class=" fw-bold mt-2 pt-0 mt-0 mb-1">Don't have an account?
                 <a href="/register"
                class="link-danger">Register</a>
            </p>
            </div>
            <div class="text-center text-lg-start mt-1 pt-2">
                
              </div>
            <!-- Submit button -->
            <div class="d-flex justify-content-center">

                <button type="submit" class="btn btn-primary btn-lg btn-block justify-content-center flex-fill">Login</button>
            </div>
  
            <div class="divider d-flex align-items-center justify-content-center my-4">
              <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
            </div>
            
            <a class="btn btn-danger btn-lg btn-block mb-4 d-flex justify-content-center"  href="#!"
              role="button">
              <i class="fab fa-twitter me-2"></i>Continue with Google</a>
            <a class="btn btn-primary btn-lg btn-block mb-4 d-flex justify-content-center" style="background-color: #3b5998" href="#!"
              role="button">
              <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
            </a>
  
          </form>
        </div>
      </div>
    </div>
  </section>
</main>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>