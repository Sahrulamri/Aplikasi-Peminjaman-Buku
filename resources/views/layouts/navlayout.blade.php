<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    @if (Auth::user())
    <a class="navbar-brand ps-3" href="{{ Auth::user()->role_id == 1 ? 'dashboard' : '/' }}">Rental Buku</a>
    @endif
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        @if (Auth::user())
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">     User :  {{ auth()->user()->username }}     <i class="fas fa-user fa-fw"></i></a>
        @else
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">     User :  User     <i class="fas fa-user fa-fw"></i></a>
        @endif
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            @if (Auth::user())
            <li><a class="dropdown-item text-center disabled text-dark" href="#"><i class="fas fa-user fa-fw"></i>   {{ auth()->user()->username }} </a></li>
            @endif
            <li><a class="dropdown-item text-center disabled text-dark" href="#"><i class="fas fa-user fa-fw"></i>   User </a></li>
              <li><hr class="dropdown-divider" /></li>
              @if (auth()->user())
              <li><a class="dropdown-item text-center" href="/logout"><i class="fas fa-sign-out"></i>  Logout  </a></li>
              @else
              <li><a class="dropdown-item text-center" href="/login"><i class="bi bi-box-arrow-in-left"></i>  Login  </a></li>
              @endif
          </ul>
      </li>
  </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                  @if (Auth::user())
                    @if (Auth::user()->role_id == 1)
                        <div class="sb-sidenav-menu-heading text-center">Admin</div>
                            <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link {{ Request::is('books*') ? 'active' : '' }}" href="/books">
                              <div class="sb-nav-link-icon"><i class="fa-solid fa-book-open"></i></div>
                              Books
                            </a>
                            <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="/categories">
                              <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                              Categories
                            </a>
                            <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="/users">
                              <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                              Users
                            </a>   
                            <a class="nav-link {{ Request::is('rent-logs*') ? 'active' : '' }}" href="/rent-logs">
                              <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                              Rent Log
                            </a>
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                              <div class="sb-nav-link-icon"><i class="bi bi-journals"></i></div>
                              Book List
                            </a>
                            <a class="nav-link {{ Request::is('bookRent*') ? 'active' : '' }}" href="/bookRent">
                              <div class="sb-nav-link-icon"><i class="bi bi-clipboard2-pulse"></i></div>
                              Book Rent
                            </a>
                            <a class="nav-link {{ Request::is('bookReturn*') ? 'active' : '' }}" href="/bookReturn">
                              <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-packing"></i></div>
                              Return Book
                            </a>
                    @else
                    {{-- Client Part --}}
                        <div class="sb-sidenav-menu-heading text-center">Client</div>
                            <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="/profile">
                              <div class="sb-nav-link-icon"><i class="fa-regular fa-address-card"></i></div>
                              Profile
                            </a>
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                              <div class="sb-nav-link-icon"><i class="bi bi-journals"></i></div>
                              Book List
                            </a>
                    @endif
                  @endif
                      <div class="sb-sidenav-menu-heading text-center">Addons</div>
                      @if (Auth::user())
                      <a class="nav-link {{ Request::is('logout') ? 'active' : '' }}" href="/logout">
                          <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                          Logout
                      </a>
                      @else
                      <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">
                        <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-in-left"></i></i></div>
                        Login
                    </a>
                      @endif
                </div>
            </div>
            <div class="sb-sidenav-footer">
                @if (auth()->user())
                <div class="small">Logged in as:</div>
                {{ auth()->user()->username }} 
                @else
                <div class="small">You're Not Login Yet</div>
                @endif
            </div>
        </nav>
    </div>