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
use App\Index_file;
use App\Location;

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
  $indice=Index_file::All();
	return view('ficha.create')->with('especialidades',$especialidades)
                             ->with('estados',$estados)
                             ->with('indice',$indice);
  }
  public function store(Request $request){
	$ficha = Ficha::create($request->all());
	flash('Ficha creada Exitosamente');
	return redirect()->route('ficha.index');
  }

  	public function show($id)
 	{
		$ficha = Ficha::where('id',$id)->with('doctor','fespecialidad','festado')->first();
    $estados= Status::All();
		return view('ficha.show')->with('ficha',$ficha)->with('estados', $estados);
  	}

	public function listar(Request $request){
		$especialidades = Auth::user();
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
    /*if(){
      Index_file::create([
        'file_name'=>$nombre
      ]);
    } */
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
          "medico_nombre" =>$dato["B"],
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
        $especialidad=Specialty::where('especialidad', 'like', '%'.$dato['A'].'%')->first();
        dd($especialidad);
		    $arreglo["medico"]=$aux->id;
        $arreglo["specialty"]=$aux->especialidad_id;
		    $arreglo["edad"]=explode(" ",$dato["G"])[0];
        $telefonos = explode("/", $dato["I"]);
        for($i=1;$i<=count($telefonos) && $i<=3;$i++)
        $arreglo["fono".$i] = trim($telefonos[$i-1]);
        $estadoPorDefecto=Status::where('estado','Por Asignar')->first();
        $arreglo["estado"]=$estadoPorDefecto->id;
        $lugarPorDefecto=Location::where('location_name','Por asignar')->first();
        $arreglo["location_id"]=$lugarPorDefecto->id;
				Ficha::create($arreglo);
			}
      flash('Datos Cargados Exitosamente');
			return $arreglo;
		}
		return;
    flash('Los datos no han podido ser cargados');

	}

// Funcion para enviar datos de medicos pertenecientes a una especialidad.
  public function getMedicos(Request $request){
    if($request->ajax()){
      $medicos=Doctor::medicosPorEspecialidad($request->id);
      return response()->json($medicos);
    }
  }
  public function mensajeria(Request $request){
    if($request->ajax()){
      $ficha=Ficha::find($request->ficha);
      $fono =$request->telefono;
      $fono=strrev($fono);
      $fono=substr($fono,0,8);
      $fono=strrev ($fono);
      $datos = [];
      $datos[] = [
          "destination" => "569$fono",
          "field" => "mensaje"
          ];
      $post = [
        'bulkName' => 'REST',
        'message' => $ficha->paciente.'. Hora para: '.$ficha->fecha.'hrs. Con Profesional: '.$ficha->doctor->nombres.'. Lugar: .',
        'message_details'   => $datos,
        ];

      try {
      	$ch = curl_init();
      	curl_setopt($ch, CURLOPT_URL, 'https://sms.lanube.cl/services/rest/send');
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
      	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      	curl_setopt($ch, CURLOPT_USERPWD, "KROPSYS:KROPSYS");
      	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      	curl_setopt($ch, CURLOPT_POST, true);
      	$response = curl_exec($ch);
      	var_export($response);
      } catch (Exception $e) {
      	var_dump($e);
        }
    return;
    }
  }
  public function changestatus(Request $request){
    if($request->ajax()){
      $ficha=Ficha::find($request->ficha);
      $estado=$request->status_id;
        $ficha->estado = $estado;
        $ficha->save();
        flash('Ficha Actualizada Exitosamente');
        return response()->json('<a class="pull-right" id="estados">{{ $ficha->festado->estado }}</a>');
    }
  }

  public function changelugar(Request $request){
    if($request->ajax()){
      $ficha=Ficha::find($request->ficha);
        $ficha->lugar = $request->lugar_id;
        $ficha->save();
        flash('Ficha Actualizada Exitosamente');
        return response()->json('<a class="pull-right" id="lugares">{{ $ficha->flocation->location_name }}</a>');
    }
  }

}
