<?php

namespace App\Http\Controllers\Admin;

/*  */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        /*  $this->middleware('auth'); */

        /* chiedere */
        /* dd('sei nel costructor'); */
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('admin.home');
    }
}
