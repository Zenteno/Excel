<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPExcel;
use PHPExcel_IOFactory;
use Datatables;

use Auth;
use App\Ficha;
use App\Doctor;
use App\Specialty;
use App\Status;
use App\User;
use App\Spe_user;


class FormularioController extends Controller
{

  public function __construct()
  {
	  $this->middleware('auth');
  }

  public function index()
  {
  		return view('ficha.index');
  }

  public function create()
  {
	$especialidades = Specialty::All();
  $estados = Status::All();
	return view('ficha.create')->with('especialidades',$especialidades)
                             ->with('estados',$estados);
  }
  public function store(Request $request){

	$ficha = Ficha::create($request->all());
	flash('Ficha creada Exitosamente');
	return redirect()->route('ficha.index');
  }

  	public function show($id)
 	{
		$ficha = Ficha::where('id',$id)->with('doctor','fespecialidad','festado')->first();
		return view('ficha.show')->with('ficha',$ficha);
  	}

	public function listar(Request $request){
	    //$user_id = Auth::id();
		//$especialidades=Spe_user::especialidadesPorUser($user_id);
		$especialidades = Auth::user();
		//return $especialidades;
		$especialidades = $especialidades->specialty()->get();
		$aux = [];
		foreach ($especialidades as $especialidad)
			$aux[] = $especialidad->id;
		$fichas = Ficha::whereIn('specialty',$aux)->with('doctor','fespecialidad','festado');
		return Datatables::of($fichas)->addColumn('action', function ($fichas) {
				return '<a href="ficha/'.$fichas->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Detalles</a>';
			})->make(true);
	}

	public function archivo(Request $request){
    if ($request->hasFile('file')) {
      	$file = $request->file('file');
		$nombre = $file->getClientOriginalName();
		$file->storeAs('public/',$nombre);
		$objPHPExcel = PHPExcel_IOFactory::load("storage/".$nombre);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$datos = $objWorksheet->toArray(null, true, true, true);
		unset($datos[1]);
     	foreach ($datos as $dato ) {
			if($dato["E"]==null)
				continue;
			$fecha  = date_create_from_format('d-m-y H:i',trim($dato["C"])." ".trim($dato["D"]));
			$arreglo = [
				"fecha"=> $fecha,
				"paciente"=> $dato["E"],
				"rut"=> $dato["F"],
				"sexo"=> $dato["H"],
				"prestacion"=> $dato["J"],
				"observacion"=> $dato["K"],
				"intento1"=> $dato["L"],
				"intento2"=> $dato["M"],
          		"intento3"=> $dato["N"]
				];
        	$medico=explode(" ",$dato["B"]);
        	for($c=1;$c<count($medico);$c++)
          		$aux = Doctor::where('nombres','like',$medico[$c-1].'%')
                		->where('nombres','like','%'.$medico[$c].'%')
                    	->first();
		        $arreglo["medico"]=$aux->id;
		        $arreglo["specialty"]=$aux->especialidad_id;
		        $arreglo["edad"]=explode(" ",$dato["G"])[0];
		        $telefonos = explode("/", $dato["I"]);
        		for($i=1;$i<=count($telefonos) && $i<=3;$i++)
					$arreglo["fono".$i] = trim($telefonos[$i-1]);
        		$estadoPorDefecto=Status::where('estado','Por Asignar')->first();
        		$arreglo["estado"]=$estadoPorDefecto->id;
				Ficha::create($arreglo);
			}
			flash('Datos Cargados Exitosamente');
			return $arreglo;
		}
		return;
	}

// Funcion para enviar datos de medicos pertenecientes a una especialidad.
  public function getMedicos(Request $request){
    if($request->ajax()){
      $medicos=Doctor::medicosPorEspecialidad($request->id);
      return response()->json($medicos);
    }
  }

}
