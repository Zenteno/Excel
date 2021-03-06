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
use App\Call_log;
use App\Callstate;

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
	$medicos = Doctor::orderBy('nombres', 'asc')->get();
  	$estados = Status::All();
  	$indice=Index_file::All();
	return view('ficha.create')->with('medicos',$medicos)
                             ->with('estados',$estados)
                             ->with('indice',$indice);
  }
  public function store(Request $request){
    $new_index= new Index_file();
    $new_index->file_name= "Ingreso Manual";
    $new_index->save();
  	$datos = $request->all();
  	$doctor = Doctor::find($datos["medico"]);
    $loc=Location::where('location_name','Por asignar')->first();
    $datos['location_id']=$loc->id;
  	$datos["specialty"] = $doctor->specialty->id;
	  $datos["fecha"] = $datos["fecha"]." ".$datos["hora"];
	  $datos["index_id"]=$new_index->id;
	$ficha = Ficha::create($datos);
	flash('Ficha creada Exitosamente');
	return redirect()->route('ficha.index');
  }

  	public function show($id)
 	{
		$ficha = Ficha::where('id',$id)->with('doctor','fespecialidad','festado','flocation')->first();
    $estados= Status::All();
    $lugares = Location::All();
    $callstates=Callstate::All();
		return view('ficha.show')->with('ficha',$ficha)
                            ->with('estados', $estados)
                            ->with('lugares', $lugares)
                            ->with('callstates', $callstates);
  	}

	public function listar(Request $request){
		$especialidades = Auth::user();
		$especialidades = $especialidades->specialty()->get();
		$aux = [];
		foreach ($especialidades as $especialidad)
			$aux[] = $especialidad->id;
		$fichas = Ficha::whereIn('specialty',$aux)->with('doctor','fespecialidad','festado','findex_file');
		return Datatables::of($fichas)->addColumn('action', function ($fichas) {
				return '<a href="ficha/'.$fichas->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Detalles</a>';
			})->make(true);
	}

	public function archivo(Request $request){
    if ($request->hasFile('file')) {
      	$file = $request->file('file');
		$nombre = $file->getClientOriginalName();
    $file->storeAs('public/',$nombre);

    $new_index= new Index_file();
    $new_index->file_name= $nombre;
    $new_index->save();

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
        try{
          $espe_sin_pt=str_replace(".","",$dato["A"]);
          $q=explode(" ", $espe_sin_pt);
          $consulta = Specialty::where('especialidad','like',$q[0].'%');
          for ($i=1; $i <count($q) ; $i++) {
              $consulta = $consulta->where('especialidad','like', '%'.$q[$i].'%');
          }
          $consulta= $consulta->first();
          $arreglo["specialty"]=$consulta->id;
        }catch(\Exception $e){
          $new_espe = new Specialty();
          $new_espe->especialidad = $dato["A"];
          $new_espe->save();

          $arreglo["specialty"]=$new_espe->id;
          flash("¡Se ha agregado una Nueva Especialidad");
        }
        try{
          $medico=explode(" ",$dato["B"]);
          $aux = Doctor::where('nombres','like',$medico[0].'%');
          for ($c=1; $c <count($medico) ; $c++) {
            $aux = $aux->where('nombres','like', '%'.$medico[$c].'%');
          }
          $aux= $aux->first();
          $arreglo["medico"]=$aux->id;
        }catch(\Exception $e){
          $new_doctor = new Doctor();
          $new_doctor->nombres = strtoupper($dato["B"]);
          $new_doctor->especialidad_id = $arreglo["specialty"];
          $new_doctor->comentarios = 'Médico ingresado por ficha.';
          $new_doctor->save();
          $arreglo["medico_nombre"]=strtoupper( $dato["B"]);
          $arreglo["medico"]=$new_doctor->id;
          flash("¡Se agregó un nuevo Médico!");
        }


		    $arreglo["edad"]=explode(" ",$dato["G"])[0];
        $telefonos = explode("/", $dato["I"]);
        for($i=1;$i<=count($telefonos) && $i<=3;$i++)
        $arreglo["fono".$i] = trim($telefonos[$i-1]);
        $estadoPorDefecto=Status::where('estado','Por Asignar')->first();
        $arreglo["estado"]=$estadoPorDefecto->id;
        $lugarPorDefecto=Location::where('location_name','Por asignar')->first();
        $arreglo["location_id"]=$lugarPorDefecto->id;
        $arreglo["index_id"]=$new_index->id;
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
  public function llamada(Request $request){
    $anexo = Auth::user();
    $fono = $request->telefono;
    $anexo = $anexo->anexo->anexo;
    $fono=strrev($fono);
    $fono=substr($fono,0,8);
    $fono=strrev ($fono);
    try {
      $arrContextOptions=array(
        "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
        ),
      );
      $xml = file_get_contents("https://192.168.0.150/generaLlamada.php?telefono=9$fono&anexo=$anexo", false, stream_context_create($arrContextOptions));
      return response()->json($xml);
      //return $response;

    } catch (\Exception $e) {
      //code catch
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
        'message' => $ficha->paciente.'. Hora para: '.$ficha->fecha.'hrs. Con Profesional: '.$ficha->doctor->nombres.'. Lugar: '.$ficha->flocation->location_name.'.',
        'message_details'   => $datos,
        ];

      try {
      	$ch = curl_init();
      	curl_setopt($ch, CURLOPT_URL, 'https://sms.lanube.cl/services/rest/send');
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
      	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      	curl_setopt($ch, CURLOPT_USERPWD, "KROPSYS:KROPSYS2017");
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

  public function confirmsms(Request $request){
    if($request->ajax()){
      $batchid = $request->batch_id;
      try {
      	$ch = curl_init();
      	curl_setopt($ch, CURLOPT_URL, 'https://sms.lanube.cl/services/rest/$batchid/status');
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      	curl_setopt($ch, CURLOPT_USERPWD, "KROPSYS:KROPSYS");
      	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      	curl_setopt($ch, CURLOPT_GET, true);
      	$response = curl_exec($ch);
      	var_export($response);
      } catch (Exception $e) {
      	var_dump($e);
        }
      /*  Check batch status:
       *  Using cURL:
       *  Check batch using:
       *  curl -v -u username -X GET https://sms.lanube.cl/services/rest/XXXXXXX/status.
       *  Replace XXXXXXX with a valid batch id.
       */
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
        $ficha=Ficha::find($request->fichaid);
        $ficha->location_id = $request->lug_id;
        $ficha->save();
        flash('Ficha Actualizada Exitosamente');
        return response()->json('<a class="pull-right" id="lugares">{{ $ficha->flocation->location_name }}</a>');
    }
  }



}
