<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Specialty;
use App\Spe_user;
use App\Role;
use App\ExtensionPhone;


class UsuarioController extends Controller
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
        $usuarios = User::all();
        return view('usuarios.index')->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected function create()
     {
         return view('usuarios.create');
     }

    public function store(Request $request)
    {

      $this->validate($request, [
        'name'      =>  'required|string|max:255',
        'apellidos' =>  'required|string|max:30',
        'rut'       =>  'required|string|max:12',
        'telefono'  =>  'required|string|min:8|max:10',
        'email'     =>  'required|string|email|max:255|unique:users',
        'password'  =>  'required|string|min:6|confirmed',
  		]);
      $usuario =User::create([
          'name' => $request['name'],
          'email' => $request['email'],
          'rut' =>$request['rut'],
          'password' => bcrypt($request['password']),
          'telefono'=> $request['telefono'],
          'apellidos' => $request['apellidos'],
      ]);
      $usuario->roles()->attach(Role::where('nombre_rol', 'Ejecutivo')->first());
      if($usuario->save()){
            flash('Usuario Creado Exitosamente');
            return redirect('usuarios');
        }
        else{
            flash('Usuario NO creado');
            return redirect('usuarios');
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $usuarios=User::find($id);
        return view('usuarios.show')->with('usuarios',$usuarios);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::where('id',$id)->with('specialty')->first();
        $especialidad = Specialty::all();
        $anexos = ExtensionPhone::all();
        return view('usuarios.edit')->with(['usuario'=> $usuario, 'especialidades'=>$especialidad])
                                    ->with('anexos', $anexos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $especialidades = $request->get('especialidad');
        $anexo_id = $request->get('anexo');
        $usuario = User::findOrFail($id);
        $usuario->anexo_id=$anexo_id;
        $usuario->save();
        flash("usuario actualizado exitosamente");
        $deletedRows = Spe_user::where('usuario', $id)->delete();
        foreach ($especialidades as $especialidad) {
            Spe_user::create([
                'especialidad' => $especialidad,
                'usuario' => $id,
                'status' => 1
            ]);
        }
        $usuarios = User::all();
        return view('usuarios.index')->with('usuarios', $usuarios);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $usuario=User::findOrFail($id);

      try{
        $usuario->delete();
        flash('Usuario Eliminado Exitosamente');
        return redirect('usuarios');
      }
      catch(\Exception $e){
          flash('Este usuario no ha podido ser eliminado, esta siendo utilizado');
          return redirect('usuarios');
      }
    }
}
