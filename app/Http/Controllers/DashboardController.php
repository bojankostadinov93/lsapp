<?php

namespace App\Http\Controllers;

//use http\Client\Curl\User; komitirano zatoa so dava greska nz tocno zaso
use Illuminate\Http\Request;
use App\User;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user= User::find($user_id);
        return view('dashboard')->with('posts',$user->posts);
    }
}
