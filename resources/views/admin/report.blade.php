@extends('admin.index')

@section('title')
  Report
@endsection

@section('header')
  <a href="{{ url('admin') }}">Dashboard </a><i class="fa fa-angle-right"></i> Report</a>
@endsection

@section('content')
  <div class="row">
      <div class="col-md-12">
          <div class="table-responsive">
              <table class="table table-hover tabel-bordered">
                  <thead>
                      <tr>
                          {{-- <th width="5">No</th> --}}
                          <th>Post Id</th>
                          <th>Post Email</th>
                          <th>Post Image</th>
                          <th>Reason</th>
                          <th>Reporter</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($reports as $i => $report)
                          <tr>
                              {{-- <td>{{ $i+1 }}</td> --}}
                              <td>{{ $report->post_id }}</td>
                              <td>{{ $report->post_email }}</td>
                              <td><a href="/img/post/{{ $report->post_file }}"><img src="/img/post/{{ $report->post_file }}" width="100" height="80"></a></td>
                              <td>{{ $report->reason }}</td>
                              <td>{{ $report->reporter }}</td>
                              <td>
                                <form style="float:left" action="/admin/report/{{$report->id}}" method="post" enctype="multipart/form-data">
                                 <input type="submit" class="btn btn-danger" name="submit" value="Delete Post">
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
