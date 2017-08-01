<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\Http\Requests\CreateStatusRequest;


class EstadosController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }


  public function index()
  {

      $estados = Status::All();
      return view('estados.index',['estados' => $estados]);
  }

  public function store(CreateStatusRequest $request)
  {
          $estados= Status::create([
             'estado'  => $request->get('estado'),
             'descripcion'  => $request->get('descripcion')
          ]);
          flash('Nuevo Estado creado Exitosamente');
  }

  public function destroy($id){

    $estados=Status::findOrFail($id);
    if($estados->delete())
    {
        flash('Estado Eliminado Exitosamente');
        return redirect('estados');
    }
    else{
        flash('Estado no ha podido ser eliminado');
        return redirect('estados');
    }

  }
}
