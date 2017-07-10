<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ficha;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fichas = Ficha::all();
        return view('prueba')->with("fichas",$fichas);
    }
}
