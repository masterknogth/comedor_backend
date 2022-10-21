<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::select('*');

        if (!is_null($request->text)) {
            $student = $student 
            ->where('cedula', 'like','%'.$request->text.'%')
            ->orWhere('nombres', 'like','%'.$request->text.'%')
            ->orWhere('apellidos', 'like','%'.$request->text.'%');
        }


        $student = $student
        ->with(['departament'])
        ->paginate($request->perPage);
        if(sizeof($student) == 0)
        {
            return response()->json(['error'=>"No hay datos"],404);
        }else{
            return response()->json(['data'=>$student],200);
        } 
    }

    public function store(Request $request){
        $rules = [
            'cedula' => 'integer|required|unique:students',
            'nombres' => 'required',
            'apellidos' => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }

        $estudiante = new Student;

        if( $estudiante->create( $request->all() ) ){
            return response()->json(['data'=>"estudiante Registrado"],200);
        }else{
            return response()->json(['error'=>"Error en el registro"],500);
        }

    }

    public function update(Request $request, $id)
    {
    
        $rules = [
            'cedula' => 'integer|required|unique:students,cedula,'.$id,
            'nombres' => 'required',
            'apellidos' => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }

        
        if( Student::where('id', $id)->update($request->all() ) ){
            return response()->json(['data'=>"Estudiante actualizado"],200);
        }else{
            return response()->json(['error'=>"Error en el registro"],500);
        }

    }

    public function destroy($id){

        if( Student::where('id',  $id)->delete() ){
           
            return response()->json(['data'=>'Estudiante eliminado'],200);
        }else{
            return response()->json(['error'=>'No se encuentra Estudiante'],404);
        }
    }
}
