@extends('layouts.app')

@section('title')
Login
@endsection

@section('style')

  .navbar
  {
      background:#2b2c2d; border:none;
  }

  .navbar-brand
  {
    font-size:15px;
  }

  .logoNav
  {
    width:30px;
    height:30px;
    float:left

  }

  .navbar-brand
  {
    padding-left:105px;
  }

  .navbar-nav
  {
    margin-right:145px;
  }

  .searchForm
  {
    margin-top:8px;margin-right:10px;margin-left:103px;width:537px;
  }

  .locForm
  {
    margin-top:8px;margin-right:70px;
  }


  @media only screen and (max-width: 768px) {
    .navbar-brand
    {
      padding-left:10px;
    }

    .navbar-nav
    {
      margin-right:0px;
    }

    .searchForm
    {
      margin:0 10px;
      width:93%;
    }

    .locForm
    {
      margin:10px 10px;
      width:93%;
    }


  }
@endsection

@section('content')
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        @guest
          <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
              <img class="logoNav" src="{{asset('img/asset/logo3.png')}}"> <i>NetInfo</i>
          </a>
        @else
          <a class="navbar-brand" href="{{ url('/user') }}" style="color:white;">
              <img class="logoNav" src="{{asset('img/asset/logo3.png')}}"> <i>NetInfo</i>
          </a>
        @endguest
      </div>
      <div class="collapse navbar-collapse pull-right" id="myNavbar">
        <ul class="nav navbar-nav">
          @guest
              <li style="float:left"><a class="nav-link" href="{{ route('login') }}" style="color:white;"><i class="fa fa-sign-in"></i> {{ __('Login') }}</a></li>
              <li><a class="nav-link" href="{{ route('register') }}" style="color:white;"><i class="fa fa-pencil-square"></i> {{ __('Register') }}</a></li>
          @else
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <img src="/img/avatar/{{ Auth::user()->avatar }}" class="img-circle" height="25" width="25" alt="Avatar" style="margin-right:10px;"> <i class="fa fa-caret-down"></i>
                </a>

                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ url('user/profil') }}"><i class="fa fa-user"></i> Profil</a></li>
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
          @endguest
        </ul>
      </div>
    </div>
  </nav><br><br><br><br>
<div class="container logbody">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="padding:20px;">
            <div class="card">
                <h2 class="text-center">Login</h2><br>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
