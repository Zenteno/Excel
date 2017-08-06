<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Specialty;
use App\Http\Requests\UpdateMedicosRequest;
use App\Http\Requests\CreateMedicosRequest;
class MedicosController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

   public function __construct()
   {
	   $this->middleware('auth');
   }

  public function index()
  {

	//  $medicos = Doctor::get();
	  $medicos= Doctor::select(["id","run","nombres","especialidad_id","comentarios"])->get();
	  //$medicos = Doctor::orderBy('especialidad_id', 'asc')->paginate();
	  return view('medicos.index')->with('medicos',$medicos);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
	  $medicos = Doctor::All();
	  $especialidades = Specialty::All();
	  return view('medicos.create', ['medicos' => $medicos], ['especialidades' => $especialidades]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
	 $medico = Doctor::create([
			  'run'         => $request->get('run'),
			 'nombres'      => $request->get('nombres'),
			 'especialidad_id' => $request->get('especialidad_id'),
			 'comentarios'     => $request->get('comentarios'),
			 ]);
	if($medico->save()){
		flash('Medico Creado Exitosamente');
		return redirect('medicos');
	}
 	else{
		flash('Medico NO creado');
		return redirect('medicos/create');
	}

  }

	public function show($id)
	{
		$medicos = Doctor::find($id);
	    return view('medicos.show')->with('medicos',$medicos);
	}

	public function edit($id)
  	{
		$medicos = Doctor::find($id);
		$especialidades = Specialty::all();
		return view('medicos.edit',compact('especialidades'))->with('medicos',$medicos);
  	}

	public function update(Request $request, $id)
	{

		$medicos = Doctor::findOrFail($id);
		$this->validate($request, [
			  'especialidad_id' => 'required|exists:specialties,id',
			  'comentarios' => 'required|string|max:500',
		]);
		$medicos->especialidad_id = $request->input('especialidad_id');
		$medicos->comentarios = $request->input('comentarios');

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
		$medicos = Doctor::find($id);
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
