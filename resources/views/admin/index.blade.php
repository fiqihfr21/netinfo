<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @yield('script')
</head>
<body>
    <div id="app">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('admin')}}">Administrator - {{ Auth::user()->name }}</a>
          </div>
          <!-- /.navbar-header -->
          <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img src="/img/avatar/{{ Auth::user()->avatar }}" class="img-circle" height="30" width="30" alt="Avatar" style="margin-right:10px;"> <i class="fa fa-caret-down"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/') }}"><i class="fa fa-reply"></i> Back To Website</a>
                        </li>
                        <li class="divider"></li>
                        {{-- <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li> --}}
                        <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>{{ __(' Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{ url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/member')}}"><i class="fa fa-group"></i> Member</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/post')}}"><i class="fa fa-newspaper-o"></i> Post</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/report')}}"><i class="fa fa-exclamation-triangle"></i> Report</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row" style="padding-top:50px;">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('header')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        <!-- /#page-wrapper -->

            <div class="content">
                @yield('content')
            </div>
        </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
