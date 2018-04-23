@extends('admin.index')

@section('title')
  Dashboard-Member
@endsection

@section('header')
  <a href="{{ url('admin') }}">Dashboard </a><i class="fa fa-angle-right"></i> Member</a>
@endsection

@section('content')
  <div class="row">
      <div class="col-md-12">
          <div class="table-responsive">
              <table class="table table-hover tabel-bordered">
                  <thead>
                      <tr>
                          <th width="5">No</th>
                          <th>Member Name</th>
                          <th>Email</th>
                          <th>action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $i => $user)
                          <tr>
                              <td>{{ $i+1 }}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                <form style="float:left" action="/admin/member/{{$user->id}}" method="post">
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
