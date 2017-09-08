<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

class Call_LogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function callstatereg(Request $request){
       if($request->ajax()){
        // $estadollamada=Callstate::find($request->estado);
         $new_log= new Call_log();
         $new_log->telefono     = $request->telefono;
         $new_log->ficha_id     = $request->ficha_id;
         $new_log->callstate_id = $request->estado;
         $new_log->comment      = $request->comentario;
         $new_log->respuestaok  = $request->respuesta;
         $new_log->mensaje      = $request->mensaje;
         $new_log->uniqueid     = $request->uniqueId; 
         $new_log->save();
           flash('Nuevo registro de llamada creado Exitosamente');
           return;
       }
     }


}
