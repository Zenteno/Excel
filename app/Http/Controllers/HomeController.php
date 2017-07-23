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
         return view('ficha.index')->with("fichas",$fichas);
     }

    public function todos(Request $request){
        $fichas = Ficha::select(["id","especialidad","medico","fecha","paciente","rut","sexo","fono1","fono2","fono3","observacion","intento1","intento2","intento3","ejecutiva"])->get();
        return Datatables::of($fichas)->addColumn('action', function ($user) {
                return '<a href="/ficha/'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })->make(true);
    }

    public function show($id)
    {
        $ficha = Ficha::find($id);
        return view('ficha.show')->with('ficha',$ficha);
    }
    public function update(Request $request, $id)
    {

        $medicos = Ficha::findOrFail($id);
        //$medicos->especialidad_id = $request->input('especialidad_id');
        //$medicos->comentarios = $request->input('comentarios');

        if($medicos->save()){
            flash('Informacion de Médico modificada Exitosamente');
            return redirect('medicos');}
        else{
            flash('Fallo en la actualizacion de información');
            return redirect('medicos');
        }
    }


    public function destroy($id)
    {
        $medicos = Ficha::find($id);
        if($medicos->delete())
        {
            flash('Médico Eliminado del Sistema');
            return redirect('medicos');
        }
        else{
            flash('Médico no ha podido ser eliminado del Sistema');
            return redirect('medicos');
        }
    }
}
