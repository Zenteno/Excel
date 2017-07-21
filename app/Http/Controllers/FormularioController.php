<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ficha;

class FormularioController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      $fichas = Ficha::all();
      return view('home.index')->with("fichas",$fichas);
  }

  public function create()
  {

      return view('home.create');
  }
  public function store(Request $request){

    $ficha = Ficha::create($request->all());
    flash('Ficha creada Exitosamente');
    return redirect()->route('home.index');
  }

  public function show($id)
  {
    $ficha = Ficha::find($id);
    return view('home.view')->with('ficha',$ficha);
  }
}
