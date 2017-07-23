<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;
use App\Http\Requests\CreateEspecialidadesRequest;

class EspecialidadesController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {

      $especialidades = Specialty::All();
      return view('especialidades.index',['especialidades' => $especialidades]);
  }

  public function create(CreateEspecialidadesRequest $request)
  {
        /*  $especialidades= Specialty::create([
             'especialidad'  => $request->get('especialidad')
           ]);*/
            $especialidades= $request->especialidad;
           flash('Especialidad creada Exitosamente');
      /*  if($especialidades->save()){
            flash('Especialidad Creada Exitosamente');
            return redirect('especialidades');
        }
        else{
            flash('Especialidad NO creada');
            return redirect('especialidades');
        }*/
  }

  public function destroy($id){

    $especialidades=Specialty::findOrFail($id);
    if($especialidades->delete())
    {
        flash('Especialidad Eliminada Exitosamente');
        return redirect('especialidades');
    }
    else{
        flash('Especialidad  no ha podido ser eliminada');
        return redirect('especialidades');
    }

  }


}
