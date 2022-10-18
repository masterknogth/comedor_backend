<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reportes = Report::select('*');


        if (!is_null($request->text) && is_null($request->fecha)) {
            $reportes = $reportes 
            ->where('cedula', 'like','%'.$request->text.'%')
            ->orWhere('nombres', 'like','%'.$request->text.'%')
            ->orWhere('apellidos', 'like','%'.$request->text.'%');
            
        }
        if (!is_null($request->fecha) && is_null($request->text)) {
        
            $newDate = date("d-m-Y", strtotime($request->fecha));
            $reportes = $reportes
            ->where('fecha', $newDate);
        }
        if (!is_null($request->tipo)) {
        
            $reportes = $reportes
            ->where('tipo', $request->tipo);
        }


        $reportes = $reportes
        ->with(['departament'])
        ->paginate($request->perPage);
        if(sizeof($reportes) == 0)
        {
            return response()->json(['error'=>"No hay datos"],404);
        }else{
            return response()->json(['data'=>$reportes],200);
        } 
    }
    public function countReport(Request $request)
    {
        //return response()->json(['data'=>$request->all()],200);
        date_default_timezone_set('America/caracas');
        if (!is_null($request->fecha)) {
            $date = date("d-m-Y", strtotime($request->fecha));
        }else{
            $date = date("d-m-Y");
        }
        $estudiantes = Report::where(['tipo'=>'E', 'fecha' => $date ])->count();
        $administrativo = Report::where(['tipo'=>'A', 'fecha' => $date ])->count();
        $docente = Report::where(['tipo'=>'D', 'fecha' => $date ])->count();
        $obrero = Report::where(['tipo'=>'O', 'fecha' => $date ])->count();
        $total = Report::where(['fecha' => $date ])->count();
        /*$data = [
            'estudiante' => $estudiantes,
            'administrativo' => $administrativo,
            'docente' => $docente,
            'obrero' => $obrero,
            'total' => $total

        ];*/
        $data = [
            $estudiantes,
            $administrativo,
            $docente,
            $obrero,
           // $total
        ];
        return response()->json(['data'=>$data],200);
    }
}
