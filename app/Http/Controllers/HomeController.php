<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Location;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        //User::withTrashed()->restore();
        $locations = Location::all();
        $posts = Post::orderBy('created_at', 'DESC')->get();
        return view('welcome', compact('locations','posts'));
    }

    public function filter(Request $request)
    {
        $object = $request->location;
        $locations = Location::all();
        $posts = Post::orderBy('post.created_at', 'DESC')->join('location', 'location.city', '=', 'post.location')->where('post.location','=',$object)->get();
        return view('welcome', compact('object','locations', 'posts'));
    }

    public function search(Request $request)
    {
        $object = $request->search;
        $locations = Location::all();
        $posts = Post::orderBy('created_at', 'DESC')->where('description','LIKE',"%$object%")->get();
        return view('welcome', compact('object','locations', 'posts'));
    }

}
