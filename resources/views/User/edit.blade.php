@extends('layouts.app')

@section('title')
Profil
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
          <img src="/img/avatar/{{ Auth::user()->avatar }}" name="aboutme" width="100" height="100" border="0" class="img-circle" style="float:left; margin:0 20px 40px 0;"></a>
          <h3 class="media-heading">{{ Auth::user()->name }}</h3><br>
          <form action="{{ url('user/profil/edit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label>Update Profil Image</label>
            <input type="file" name="avatar"><br>
            @if ($errors->has('avatar'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('avatar') }}</strong>
                </span>
            @endif<br>
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}"><br>
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}"><br>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <label>Location</label>
            <select name="location" class="form-control">
                <option value="Jakarta">Jakarta</option>
                <option value="Bogor">Bogor</option>
                <option value="Depok">Depok</option>
                <option value="Bali">Bali</option>
            </select>
            @if ($errors->has('location'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @endif
            <br>
            <input type="submit" class="btn btn-info" name="submit" value="Edit">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
