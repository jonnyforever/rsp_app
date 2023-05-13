<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        //session functions
        //$request->session()->put(['jon' => 'admin man']);
        //session(['jon2' => "jsdjsdjhfj"]);
        //$request->session()->flush();
        //echo $request->session()->get('jon');
        //echo $request->session()->all();//->get('jon');
        //$request->session()->forget('jon');
        //$request->session()->flush();

        //flash removes the data after it is viewed
        //$request->session()->flash('message', 'Post created');
        //return $request->session()->get('message');

        \App\Helpers\GlobalFunctions::test();

        return view('home');
    }
}
