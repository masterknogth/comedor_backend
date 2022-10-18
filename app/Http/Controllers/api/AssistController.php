<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Assist;
use App\Models\Personal;
use App\Models\Student;
use App\Models\Report;


class AssistController extends Controller
{
    

    public function readCarnet(Request $request)
    {
       // return $request->codigo;
        //$id = '20BJ75A22';
        //$id = '20bj75a22'; 
       // $id = '1YUX32E12'; 
        //$id='106439';
       //$id='2497514';
        $id = $request->codigo;
        if(preg_match('/A|B|C|D|E|F|G|H|I|J|K|L|M|N|O|P|Q|R|S|T|U|V|W|X|Y|Z|a|b|c|d|e|f|g|h|i|j|k|l|m|n|o|p|q|r|s|t|u|v|w|x|y|z/', $id)) {
                      
            //"DECODIFICA PORQUE SE PUSO EL CODIGO DE BARRAS <br>";

            $codecimal =base_convert ( substr($id ,0, -3), 36 , 10 ); //converto el codigo  a decimal
            $ced=substr($codecimal,1);// elimino el primer caracter pues ese no hace falta
            $num= (int)$ced;//convierto la cedula decodificada en un entero para ser leido 
            
            $assist = Assist::where('cedula', $id)->first();
            $personal = Personal::where('cedula', $id)->first();       
            $student = Student::where('cedula', $id)->first();
        
            if($assist){
                $personal->departament;
                return response()->json(['data'=>$assist],200);
            }
            if($personal){
                $this->insertAssists($personal);
                $this->insertReport($personal);
                $personal->departament;
                return response()->json(['data'=>$personal],200);
            }
            if($student){
                $this->insertAssists($student);
                $this->insertReport($student);
                $student->departament;
                return response()->json(['data'=>$student],200);
            }
            return response()->json(['data'=>'no existe usuario'],200);

        }else{
            //"NO DE CODIFICA PORQUE PONES LA CI DIRECTA <br>";
            $assist = Assist::where('cedula', $id)->first();
            $personal = Personal::where('cedula', $id)->first();       
            $student = Student::where('cedula', $id)->first();
        
            if($assist){
                $assist->departament;
                return response()->json([
                    'data'=>$assist,
                    'message' => 'Este usuario ya hizo uso del comedor',
                    'error' => true
                ],200);
            }
            if($personal){
                $this->insertAssists($personal);
                $this->insertReport($personal);
                $personal->departament;
                return response()->json(['data'=>$personal],200);
            }
            if($student){
                $this->insertAssists($student);
                $this->insertReport($student);
                $student->departament;
                return response()->json(['data'=>$student],200);
            }
            return response()->json([
                'data'=>'no existe usuario',
                'message' => 'Este no usuario Existe',
                'error' => true
            ],200);

        } 
        
    }

    public function insertAssists($data)
    {
        date_default_timezone_set('America/caracas');
        $user = Auth::user();
        $fecha = date('d-m-Y');
        $hora = date('H:i');

        $assist = new Assist();
        $assist->cedula = $data->cedula;
        $assist->apellidos = $data->apellidos;
        $assist->nombres = $data->nombres;
        $assist->departamento = $data->departamento;
        $assist->tipo = $data->tipo;
        $assist->fecha = $fecha;
        $assist->hora = $hora;
        $assist->user_id = $user->id;
        $assist->save();
    }
    public function insertReport($data)
    {
        date_default_timezone_set('America/caracas');
        $user = Auth::user();
        $fecha = date('d-m-Y');
        $hora = date('H:i');

        $report = new Report();
        $report->cedula = $data->cedula;
        $report->apellidos = $data->apellidos;
        $report->nombres = $data->nombres;
        $report->departamento = $data->departamento;
        $report->tipo = $data->tipo;
        $report->fecha = $fecha;
        $report->hora = $hora;
        $report->user_id = $user->id;
        $report->save();
    }

    // cuenta la cantidad de estudiantes, personal y el total
    public function count()
    {
        $estudiantes = Assist::where('tipo','E')->count();
        $obreros = Assist::where('tipo','O')->count();
        $administrativo = Assist::where('tipo','A')->count();
        $docente = Assist::where('tipo','D')->count();
        $total = Assist::count();

        $data = [
            'estudiante' => $estudiantes,
            'obrero' => $obreros,
            'administrativo' => $administrativo,
            'docente' => $docente,
            'total' => $total

        ];
        return response()->json(['data'=>$data],200);
    }

}
