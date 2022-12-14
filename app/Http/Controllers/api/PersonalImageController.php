<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\PersonalImage;
use App\Models\Personal;
use App\Models\Job;
use App\Models\QueuesImports;

use App\Jobs\Logger;


class PersonalImageController extends Controller
{
    public function index(Request $request)
    {
        $personal_images = PersonalImage::select('*');
     

        if (!is_null($request->text)) {
            $personal_images = $personal_images 
            ->where('cedula', 'like','%'.$request->text.'%');
        }


        $personal_images = $personal_images
        ->with(['personal'])
        ->paginate($request->perPage);
        if(sizeof($personal_images) == 0)
        {
            return response()->json(['error'=>"No hay datos"],404);
        }else{
            return response()->json(['data'=>$personal_images],200);
        } 

    }
    public function impotarPersonalFoto(Request $request)
    {
        $cont = 0;
    
        for($i = 1; $i <= $request->cantidadfotos; $i++){
            $cont++;
            $file = $request->file('fotos'.$cont);
            $originalname = $file->getClientOriginalName();
 
            
            $personal_images = PersonalImage::where('cedula',substr($originalname ,0, -4))->first();
            $personal = Personal::where('cedula',substr($originalname ,0, -4))->first();

            if(!$personal_images && $personal){

                $path = $file->storeAs('public/personal', ltrim($originalname,'0'));

                $cedula = substr($originalname ,0, -4);
                $ceduna_sin_ceros = ltrim($cedula, '0');
                $personal_image = new PersonalImage;
                $personal_image->cedula = $ceduna_sin_ceros;
                $personal_image->path = 'storage/personal/'.ltrim($originalname,'0');
                $personal_image->save();
            }
  

        }
        return response()->json(['data' => 'Fotos importadas'], 200);
        
        
    }

    public function queue(Request $request)
    {
        /*$job = QueuesImports::where('name','fotos_personal')->first();
        
        if($job){

        }else{
            \Artisan::call('personal:photos');
        }*/

    
        
        //Logger::dispatch()->onConnection('database');
        $job = Job::where('queue', 'default')->first();
        
        if($job){
            //return response()->json(['data' => 'si hay'], 200);
            //\Artisan::queue('queue:work');
            //\Artisan::call('queue:work');
            /*
                Artisan::call('email:send', [
                    'user' => 1, '--queue' => 'default'
                ]);
                Artisan::queue('email:send', [
                    'user' => 1, '--queue' => 'default'
                ]);
            */
        
            
        }else{
            //Logger::dispatch();
            Logger::dispatch()->onQueue('personalPhoto');
            
        }

        
        //Logger::dispatch()->onQueue('secondary');
        //\Artisan::queue('queue:work');
        //\Artisan::call('queue:work');
        
        return response()->json(['data' => 'Fotos importadas'], 200);
    }
}

