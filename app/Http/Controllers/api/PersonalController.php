<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Student;


class PersonalController extends Controller
{
    public function index(Request $request)
    {
        /*$personal = Personal::select(
            'cedula','numero', 'apellidos', 'nombres', 'exonerado','inactivo', 'departamento',
            'tipo', 'mes', 'acumulado', 'ingreso', 'mensaje'
        );*/
        $personal = Personal::select('*');

        

        if (!is_null($request->text)) {
            $personal = $personal 
            ->where('cedula', 'like','%'.$request->text.'%')
            ->orWhere('nombres', 'like','%'.$request->text.'%')
            ->orWhere('apellidos', 'like','%'.$request->text.'%')
            ->orWhere('numero', 'like','%'.$request->text.'%');
        }


        $personal = $personal
        ->with(['departament'])
        ->paginate($request->perPage);
        if(sizeof($personal) == 0)
        {
            return response()->json(['error'=>"No hay datos"],404);
        }else{
            return response()->json(['data'=>$personal],200);
        } 
    }
    //recibe la data del personal a travez de un excel
    public function import(Request $request)
    {
        $data = $request->all();
        //
       
        if($data['tipo'] == 'e' && $data['datos'][0]['tipo'] != 'E'){
            return response()->json(['data'=> "no es estudiante" ],200);
        }
        if($data['tipo'] != 'e' && $data['datos'][0]['tipo'] == 'E'){
            return response()->json(['data'=> "no es personal" ],200);
        }

        if($data['tipo'] == 'e'){
            \DB::table('students')->delete();
            foreach($data['datos'] as $datos){
            
                $estudiante = new Student();
                $estudiante->tipo = $datos['tipo'];
                $estudiante->cedula = $datos['cedula'];
                $estudiante->apellidos = $datos['apellidos'];
                $estudiante->nombres = $datos['nombres'];
                $estudiante->sexo = $datos['sexo'];
                $estudiante->departamento = $datos['departamento'];
                $estudiante->a_cursar = $datos['a_cursar'];
                $estudiante->inactivo = $datos['inactivo'];
                $estudiante->fecha_rdoc = $datos['fecha_rdoc'];
                $estudiante->fecha_ret = $datos['fecha_ret'];
                $estudiante->mensaje = $datos['mensaje'];
                $estudiante->exonerado = $datos['exonerado'];
                             
                $estudiante->save();
            }
        }
        if($data['tipo'] != 'e'){
            \DB::table('personals')->delete();
            foreach($data['datos'] as $datos){
            
                $personal = new Personal();
                $personal->cedula = $datos['cedula'];
                $personal->numero = $datos['numero'];
                $personal->apellidos = $datos['apellidos'];
                $personal->nombres = $datos['nombres'];
                $personal->exonerado = $datos['exonerado'];
                $personal->inactivo = $datos['inactivo'];
                $personal->departamento = $datos['departamento'];
                $personal->tipo = $datos['tipo'];
                $personal->mes = $datos['mes'];
                $personal->acumulado = $datos['acumulado'];
                $personal->ingreso = $datos['ingreso'];
                $personal->mensaje = $datos['mensaje'];
                
                $personal->save();
            }
        }
        //\DB::table('personals')->delete();
         
        
        //return response()->json(['data'=>$data['tipo'] ],200);
        
        return response()->json(['data'=>$data['datos'] ],200);
    }

    public function store(Request $request){
        $rules = [          
            'cedula' => 'integer|required|unique:personals',
            'nombres' => 'required',
            'apellidos' => 'required',
            'tipo' => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }

        $personal = new Personal;

        if( $personal->create( $request->all() ) ){
            return response()->json(['data'=>"personal Registrado"],200);
        }else{
            return response()->json(['error'=>"Error en el registro"],500);
        }

    }

    public function update(Request $request, $id)
    {
    
        $rules = [
            'cedula' => 'integer|required|unique:personals,cedula,'.$id,
            'nombres' => 'required',
            'apellidos' => 'required',
            'tipo' => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }

 
        
        if( Personal::where('id', $id)->update($request->all() ) ){
            return response()->json(['data'=>"personal actualizado"],200);
        }else{
            return response()->json(['error'=>"Error en el registro"],500);
        }

    }

    public function destroy($id){

        if( Personal::where('id',  $id)->delete() ){           
            return response()->json(['data'=>'Personal eliminado'],200);
        }else{
            return response()->json(['error'=>'No se encuentra Personal'],404);
        }
    }

    
}
