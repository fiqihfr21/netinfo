<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\User;
use App\Post;
use App\Report;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        // restore SoftDeletes
        // User::withTrashed()->restore();
        // Post::withTrashed()->where('id', 1)->restore();
        $data['users'] = \App\User::whereDoesntHave('roles')->get();
        return view('admin.dashboard', $data);
    }

    public function member()
    {
        $data['role'] = \App\UserRole::whereUserId(Auth::id())->get();
        $users = User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id','=','2')->paginate(30);
        return view('admin.member', compact('data','users'));
    }

    public function memberDelete($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect('admin/member');
    }

    public function post()
    {
       $post = Post::all();
       return view('admin/post', compact('post'));
    }

    public function postDelete($id)
    {
        $posts = Post::find($id);
        $posts->delete();
        return redirect('admin/post');
    }

    public function report()
    {
        $reports = Report::all();
        return view('admin/report', compact('reports'));
    }

    public function reportDelete($id)
    {
       $reports = Report::find($id);
       $reports->delete();
       return view('admin/report', compact('reports'));
    }
}
