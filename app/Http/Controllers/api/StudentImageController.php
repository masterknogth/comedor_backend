<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentImage;
use App\Models\Student;


class StudentImageController extends Controller
{
    public function index(Request $request)
    {
        $student_images = StudentImage::select('*');
     

        if (!is_null($request->text)) {
            $student_images = $student_images 
            ->where('cedula', 'like','%'.$request->text.'%');
        }


        $student_images = $student_images
        ->with(['estudiante'])
        ->paginate($request->perPage);
        if(sizeof($student_images) == 0)
        {
            return response()->json(['error'=>"No hay datos"],404);
        }else{
            return response()->json(['data'=>$student_images],200);
        } 

    }

    public function impotarEstudianteFoto(Request $request)
    {
        $cont = 0;
    
        for($i = 1; $i <= $request->cantidadfotos; $i++){
            $cont++;
            $file = $request->file('fotos'.$cont);
            $originalname = $file->getClientOriginalName();
 
            
            $student_images = StudentImage::where('cedula',substr($originalname ,0, -4))->first();
            $student = Student::where('cedula',substr($originalname ,0, -4))->first();

            if(!$student_images && $student){

                $path = $file->storeAs('public/estudiante', ltrim($originalname,'0'));

                $cedula = substr($originalname ,0, -4);
                $ceduna_sin_ceros = ltrim($cedula, '0');
                $student_image = new StudentImage;
                $student_image->cedula = $ceduna_sin_ceros;
                $student_image->path = 'storage/estudiante/'.ltrim($originalname,'0');
                $student_image->save();
            }
  

        }
        return response()->json(['data' => 'Fotos importadas'], 200);
        
        
    }
}
