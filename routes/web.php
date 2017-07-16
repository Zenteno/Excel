<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use PHPExcel;
use PHPExcel_IOFactory; 

use App\Ficha;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/create',function(){
	return view('home.create');
});
Route::post('/create', function(Request $request){
	Ficha::create($request->all());
	flash('Ficha creada Exitosamente');
	return redirect()->route('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/formularios/{id}', function($id){
	$ficha = Ficha::find($id);
	return view('home.view')->with('ficha',$ficha);
});

Route::get('/ficha/todos',function(Request $request){
	$users = Ficha::select(["id","especialidad","medico","fecha","paciente","rut","sexo","fono1","fono2","fono3","observacion","intento1","intento2","intento3","ejecutiva"])->get();
    return Datatables::of($users)->addColumn('action', function ($user) {
                return '<a href="/formularios/'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })->make(true);
});

Route::post('/archivo', function(Request $request){
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

});