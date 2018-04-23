<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use Auth;
use Session;
use Image;

class profilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->where('email','=',Auth::user()->email)->get();
        //dd($posts);
        return view('User.profil', compact('posts'));
    }

    public function edit()
    {
        $users = User::all();
        if(!$users)
        abort(404);
        return view('User.edit', compact('users'));
    }

    public function update(request $request)
    {
        if($request->hasFile('avatar'))
        {
          $img = $request->file('avatar');
          $filename = time().'.'.$img->getClientOriginalName();
          Image::make($img)->save( public_path('/img/avatar/'.$filename));

          $users = Auth::user();
          $users->avatar = $filename;
          $users->name = $request->name;
          $users->location = $request->location;
          $users->email = $request->email;
          $users->save();
          return redirect('user/profil');
        }

        $users = Auth::user();
        $users->name = $request->name;
        $users->location = $request->location;
        $users->email = $request->email;
        $users->save();
        return redirect('user/profil');
    }

}
