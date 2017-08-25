<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Specialty;
use App\Spe_user;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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



     protected function validator(array $data)
     {
         return Validator::make($data, [
             'name'      =>  'required|string|max:255',
             'apellidos' =>  'required|string|max:30',
             'rut'       =>  'required|string|max:12',
             'telefono'  =>  'required|string|min:8|max:10',
             'email'     =>  'required|string|email|max:255|unique:users',
             'password'  =>  'required|string|min:6|confirmed',
         ]);
     }


    public function store(Request $request)
    {
      $usuario =User::create([
          'name' => $request['name'],
          'email' => $request['email'],
          'rut' =>$request['rut'],
          'password' => bcrypt($request['password']),
          'telefono'=> $request['telefono'],
          'apellidos' => $request['apellidos'],
      ]);

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
        return view('usuarios.edit')->with(['usuario'=> $usuario, 'especialidades'=>$especialidad]);
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
      if($usuario->delete())
      {
          flash('Usuario Eliminado Exitosamente');
          return redirect('usuarios');
      }
      else{
          flash('Este usuario no ha podido ser eliminado');
          return redirect('usuarios');
      }
    }
}
