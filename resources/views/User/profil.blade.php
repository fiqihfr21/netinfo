@extends('layouts.app')

@section('title')
Profil
@endsection

@section('style')
  .fa-comment-o, .fa-exclamation-triangle
  {
    font-size:20px;
  }

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
  .break-word
  {
    width: 100%;
    overflow-wrap: break-word;
    white-space:pre-wrap;
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
      <div class="col-sm-12">
        <div class="well">
          <center>
            <a href="{{ url('user/profil/edit') }}"><img src="/img/avatar/{{ Auth::user()->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a><br><br>
            <h3 class="media-heading">{{ Auth::user()->name }}</h3>
          </center>
          <center>
            <p class="text-left"><strong>Email : </strong><br>
              {{ Auth::user()->email }}</p>
            <p class="text-left"><strong>Location : </strong><br>
              {{ Auth::user()->location }}</p>
            <br>
          </center>
          <a href="{{ url('user/profil/edit') }}" class="btn btn-info">Edit Profil</a>
        </div>
      </div>
    </div>
  </div>
  <div class="container text-center">
    <div class="row">
      <div class="col-sm-7 col-sm-offset-1">
        @foreach ($posts as $post)

        <div class="row">
          <div class="col-sm-12">
            <img src="/img/post/{{ $post->file }}" width="100%" height="100%">
            <div class="well text-left" style="border-radius:0px;">
              <p style="float:right;"><small><i>
                @if( $post->updated_at->subDays(30) )
                  {{ $post->updated_at->diffForHumans() }}
                @else
                  {{ $post->updated_at->format('j M Y , g:ia') }}
                @endif</i></small>
              </p>
              <p><b>{{ $post->name }}</b>
              </p>
              <p class="break-word">{{ $post->description }}</p>
              <p>@include('laravelLikeComment::like', ['like_item_id' => $post->id ])</p>
              <p style="float:left;margin:0 10px;"> <a href="{{$post->id}}" alt="report"><i class="fa fa-comment-o"></i></a></p>
              <p><a href="{{$post->id}}/report" alt="report"><i class="fa fa-exclamation-triangle"></i></a></p>
            </div>
          </div>
        </div>

        @endforeach
      </div>
      <div class="col-sm-2 well">
        <p>&copy; 2018 NETINFO</p>
      </div>
    </div>
  </div>


@endsection
