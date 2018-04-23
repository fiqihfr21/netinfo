@extends('layouts.app')

@section('style')
.image-upload > input
{
    display:none;
}

.input-f
{
    cursor:pointer;
}

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

.searchForm
{
  margin-top:8px;margin-right:10px;margin-left:103px;width:537px;
}

.locForm
{
  margin-top:8px;margin-right:70px;
}

.break-word
{
  width: 100%;
  overflow-wrap: break-word;
  white-space:pre-wrap;
}

.image-upload
{
  float:right;margin:5px 10px 0 10px;
}

.img-post
{
  width:50px;
  height:50px;
  float:left; margin-right:10px;
}

.desc
{
  width:90%; margin:5px 0 0 10px;
}

@media only screen and (max-width: 768px) {
  .navbar-brand
  {
    padding-left:10px;
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

  .desc
  {
    width:75%;
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
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="formS searchForm">
            <form action="{{url('/user/src')}}" method="post" class="">
              @csrf
             <div class="input-group">
               <input type="text" class="form-control" placeholder="Search" name="search" style="border-radius:0px;">
               <div class="input-group-btn">
                 <button class="btn btn-default" type="submit" style="border-radius:0px;">
                   <i class="glyphicon glyphicon-search"></i>
                 </button>
               </div>
             </div>
            </form>
          </li>
          <li class="formS locForm">
            <form action="{{url('/user/loc')}}" method="post" class=" ">
              @csrf
                <select name="location" onchange="this.form.submit()" class="form-control" style="border-radius:0px;">
                    <option value=""><b>Location</b></option>
                  @foreach ($locations as $location)
                    <option value="{{$location->city}}">{{$location->city}}</option>
                  @endforeach
                </select>
            </form>
          </li>
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

  <div class="container text-center">
    <div class="row">
      <div class="col-sm-7 col-sm-offset-2">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default text-left">
              <div class="panel-body">
                <img src="/img/avatar/{{ Auth::user()->avatar }}" class="img-circle img-post" alt="Avatar">
                <form action="{{ url('user/upload') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <span>
                    <textarea class="form-control desc" rows="2" name="description" maxlength="1000"></textarea>
                  </span><br>
                  @if($errors->has('description'))
                    <span>{{ $errors->first('description') }}</span>
                  @endif
                  <button class="btn btn-info" type="submit" name="submit" style="float:right;"><i class="fa fa-pencil-square-o"></i> Send</button>
                  <div class="image-upload">
                    <input type="file" id="file-input" name="file">
                    @if($errors->has('file'))
                      <span>{{ $errors->first('file') }}</span>
                    @endif
                    <label for="file-input" class="input-f"><span class="fa fa-file-image-o"></span></label>
                  </div>
                  {{-- <input id="uploadFile" placeholder="Pilih File..." disabled="disabled" style="float:right;" /> --}}
                </form>
              </div>
            </div>
          </div>
        </div>

        @foreach ($posts as $post)

        <div class="row">
          <div class="col-sm-12" >
            <img src="/img/post/{{ $post->file }}" width="100%" height="100%">
            <div class="well text-left" style="border-radius:0px;">
              <p style="float:right;"><small><i>
                @if( $post->created_at->subDays(30) )
                  {{ $post->created_at->diffForHumans() }}
                @else
                  {{ $post->created_at->format('j M Y , g:ia') }}
                @endif</i></small>
              </p>
              <p><b>{{ $post->name }}</b></p>
              <p class="break-word" id="description">{{ $post->description }}</p>
              <p>@include('laravelLikeComment::like', ['like_item_id' => $post->id ])</p>
              <p style="float:left;margin:0 10px;"> <a href="user/{{$post->id}}" alt="report"><i class="fa fa-comment-o"></i></a></p>
              <p><a href="user/{{$post->id}}/report" alt="report"><i class="fa fa-exclamation-triangle"></i></a></p>
            </div>
          </div>
        </div>

        @endforeach
      </div>
      <div class="col-sm-3">
        <p><small>&copy; 2018 NETINFO, All right reserved</small></p>
      </div>
    </div>
  </div>

@endsection
