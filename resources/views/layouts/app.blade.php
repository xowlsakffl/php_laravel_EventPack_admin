<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Events Pack') }}</title>


    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/scroll/jquery.mCustomScrollbar.js') }}"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
</head>
<body>
  <header>
      <div class="left_area">  
        <a href="{{url('/')}}" class="logo">
            EVENTS <span>PACK</span>
        </a>
        <button class="menu-btn">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <div class="right_area">
        <button class="auth_btn">
          <span>{{-- {{Auth::user()->name}} --}}</span>
          <i class="fas fa-caret-down"></i>
        </button>
        <ul class="auth_box">
          <!-- Authentication Links -->
          @auth
              <li>
                <a href="">
                  <i class="fas fa-tasks"></i>
                  프로젝트
                </a>
              </li>
              <li>
                <a href="">
                  <i class="far fa-user"></i>
                  사용자
                </a>
              </li>
              <li class="logout_li">
                  <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                      <i class="fas fa-sign-out-alt"></i>
                      {{ __('로그아웃') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </li>
          @endauth
        </ul>
      </div>
    </header>
    
    @include('layouts.menu')
    
    <main class="main">
      @include('flash::message')
      @yield('content')
    </main>
</body>
</html>
