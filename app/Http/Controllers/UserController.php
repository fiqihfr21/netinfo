<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use DB;
use App\Post;
use App\Report;
use App\Location;
use App\comment;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Auth;
use Carbon\Carbon;
use Storage;
use Session;
use Image;

class UserController extends Controller
{
      public function __construct()
      {
          $this->middleware('auth');
      }

      public function index()
      {
          $locations = Location::all();
          $posts = Post::orderBy('created_at', 'DESC')->where('location','=',Auth::user()->location)->get();
          // dd($posts);
          return view('User/user', compact('locations','posts','comments'));
      }

      public function filter(Request $request)
      {
          $object = $request->location;
          $locations = Location::all();
          $posts = Post::orderBy('post.created_at', 'DESC')->join('location', 'location.city', '=', 'post.location')->where('post.location','=',$object)->get();
          return view('User/user', compact('object','locations', 'posts'));
      }

      public function search(Request $request)
      {
          $object = $request->search;
          $locations = Location::all();
          $posts = Post::orderBy('created_at', 'DESC')->where('description','LIKE',"%$object%")->get();
          return view('User/user', compact('object','locations', 'posts'));
      }

      public function upload(request $request)
      {
          $this->validate($request, [
          'description' => 'required|min:1|max:1000',
          'file' => 'required|file|max:2000', // max 2MB
          ]);

          $posts = new Post;
          $posts->description = $request->description;
          $posts->name = Auth::user()->name;
          $posts->email = Auth::user()->email;
          $posts->location = Auth::user()->location;
          $posts->created_at = \Carbon\Carbon::now();
          $posts->updated_at = \Carbon\Carbon::now();
          $img = $request->file('file');
          $filename = time().'.'.$img->getClientOriginalName();
          Image::make($img)->save( public_path('/img/post/'.$filename));
          $posts->file = $filename;
          $posts->save();

          return redirect('user');
      }

      public function report($id)
      {
          $posts = Post::find($id);
          return view('User/report', compact('posts'));
      }

      public function storeReport(Request $request)
      {
          $reports = new Report;
          $reports->post_id = $request->post_id;
          $reports->post_email = $request->post_email;
          $reports->post_file = $request->post_file;
          $reports->reason = $request->reason;
          $reports->reporter = $request->reporter;
          $reports->created_at = \Carbon\Carbon::now();
          $reports->updated_at = \Carbon\Carbon::now();
          $reports->save();
          return view('user/thanksreport');
      }

      public function storeComment(Request $request, $id)
      {
            $this->validate($request, [
            'comment' => 'required|min:1|max:100',
            ]);

            $posts = Post::find($id);
            $post = $posts->id;

            $comments = new comment;
            $comments->postid = $post;
            $comments->userid = Auth::user()->id;
            $comments->comment = $request->comment;
            $comments->created_at = \Carbon\Carbon::now();
            $comments->updated_at = \Carbon\Carbon::now();
            $comments->save();
            return redirect()->action('UserController@getComment', $id);
      }

      public function getComment($id)
      {
          $object = Post::find($id);
          $comments = comment::orderBy('created_at', 'DESC')->where('postid','=',$object->id)->get();
          return view('User/comment', compact('object', 'comments'));
      }
}
