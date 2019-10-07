<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/components.css">
  </head>
  <body>
    <div id="app">
      <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
              <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                  <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                </ul>
                {{-- <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div> --}}
              </form>
              <input type="hidden" id="invitation" data-hash=" {{ route('home') }}/register/{{ encrypt(Auth::user()->email) }}">
              <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                  <img alt="image" src="/img/avatar/avatar-1.png" width="30" class="rounded-circle mr-1">
                  <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a href="/profile" class="dropdown-item has-icon">
                      <i class="far fa-user"></i> My Profile
                    </a>
                    <a href="/tickets" class="dropdown-item has-icon">
                      <i class="fas fa-bolt"></i> Issue Tickets
                    </a>
                  <a href="#" class="dropdown-item has-icon" onclick="show()">
                        <i class="fas fa-user-plus"></i> Show my Invitation Link
                      </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout')}}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                      <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </nav>
        @extends('nav')
        <!-- Main Content -->
        <div class="main-content">
        @if(Session::has('alert-success'))
            <div class="alert alert-success alert-has-icon alert-dismissible show fade">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Success</div>
                  <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                  </button>
                  <h6>{!! session('alert-success') !!}</h6>
                </div>
            </div>
        @endif
        @if(Session::has('alert-warning'))
            <div class="alert alert-warning alert-has-icon alert-dismissible show fade">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">warning</div>
                  <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                  </button>
                  <h6>{!! session('alert-warning') !!}</h6>
                </div>
            </div>
        @endif
            
          @yield('content')
        </div>
        @extends('footer')
      </div>
    </div>
    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="/js/stisla.js"></script>
    <script src="/js/sweet-alert.js"></script>

    <!-- Plugins -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="/js/scripts.js"></script>
    <script src="/js/custom.js"></script>
    <script>
      function show() {
        const hash = document.querySelector('#invitation').dataset.hash;
	      swal('Your Invitation Link', hash, 'success');
      };
    </script>
    @yield('script')
  </body>
  </html>