<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPExcel;
use PHPExcel_IOFactory; 
use Datatables;

use App\Ficha;
use App\Doctor;
use App\Specialty;

class FormularioController extends Controller
{

  public function __construct()
  {
	  $this->middleware('auth');
  }

  public function index()
  {
	  $fichas = Ficha::all();
	  return view('ficha.index')->with("fichas",$fichas);
  }

  public function create()
  {
  	$medicos = Doctor::All();
	$especialidades = Specialty::All();
	return view('ficha.create', ['medicos' => $medicos], ['especialidades' => $especialidades]);
  }
  public function store(Request $request){

	$ficha = Ficha::create($request->all());
	flash('Ficha creada Exitosamente');
	return redirect()->route('ficha.index');
  }

  	public function show($id)
 	{
		$ficha = Ficha::find($id);
		return view('ficha.show')->with('ficha',$ficha);
  	}			

	public function listar(Request $request){
		$fichas = Ficha::with('doctor','fespecialidad');
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
				$arreglo = [
					"especialidad"=> $dato["A"],
					"medico"=>$dato["B"] ,
					"fecha"=> $dato["D"]." ".$dato["C"],
					"paciente"=> $dato["E"],
					"rut"=> $dato["F"],
					"sexo"=> $dato["G"],
					"observacion"=> $dato["I"],
					"intento1"=> $dato["J"],
					"intento2"=> $dato["K"],
					"intento3"=> $dato["L"],
					"ejecutiva"=> $dato["M"]
				];
				$telefonos = explode("/", $dato["H"]);
				for($i=1;$i<=count($telefonos) && $i<=3;$i++)
					$arreglo["fono".$i] = trim($telefonos[$i-1]);
				Ficha::create($arreglo);
			}
			flash('Datos Cargados Exitosamente');
			return $arreglo;
		}
		return;
	}
}
