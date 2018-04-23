@extends('layouts.app')

@section('title')
Report
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
  <div class="container">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="well">
          <form action="{{ url('user/report') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label>Alasan anda merepot post ini ?</label>
            <select name="reason" class="form-control">
              <option value="Kontent Hoax">Kontent Hoax</option>
              <option value="Kontent Mengganggu">Kontent Mengganggu</option>
              <option value="Kontent Tidak Pantas">Kontent Tidak Pantas</option>
            </select><br>
            @if ($errors->has('reason'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('reason') }}</strong>
                </span>
            @endif
            <input type="hidden" name="post_id" value="{{ $posts->id }}">
            <input type="hidden" name="post_email" value="{{ $posts->email }}">
            <input type="hidden" name="post_file" value="{{ $posts->file }}">
            <input type="hidden" name="reporter" value="{{ Auth::user()->email }}">
            <input type="submit" class="btn btn-info" name="submit" value="Report">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
