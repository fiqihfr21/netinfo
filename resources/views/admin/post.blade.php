@extends('admin.index')

@section('title')
  Dashboard-Member
@endsection

@section('header')
  <a href="{{ url('admin') }}">Dashboard </a><i class="fa fa-angle-right"></i> Post</a>
@endsection

@section('content')
  <div class="row">
      <div class="col-md-12">
          <div class="table-responsive">
              <table class="table table-hover tabel-bordered">
                  <thead>
                      <tr>
                          <th width="5">No</th>
                          <th>Post Name</th>
                          <th>Post Description</th>
                          <th>Post Image</th>
                          <th>action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($post as $i => $posts)
                          <tr>
                              <td>{{ $i+1 }}</td>
                              <td>{{ $posts->name }}</td>
                              <td>{{ $posts->description }}</td>
                              <td><a href="/img/post/{{ $posts->file }}"><img src="/img/post/{{ $posts->file }}" width="100" height="80"></a></td>
                              <td>
                                <form style="float:left" action="/admin/post/{{$posts->id}}" method="post">
                                 <input type="submit" class="btn btn-danger" name="submit" value="Delete">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="_method" value="DELETE">
                               </form>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
@endsection
