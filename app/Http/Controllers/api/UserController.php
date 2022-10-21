<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assist;

class UserController extends Controller
{
    public function login(Request $request)
    {
        date_default_timezone_set('America/caracas');
        $today = date('d-m-Y');
        $rules = [
            'user' => 'required|string',
            'password' => 'required|string',
        ];
        
        
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['created' => false, 'error' => $validator->errors()], 422);
        }

        // al iniciar sesion vera si el ultimo en comer fue un dia diferente al de hoy
        // y borra todos los usuarios que han comido
        $consulta = Assist::latest()->first();
        if($consulta && $consulta->fecha != $today){
            Assist::query()->delete();    
        }

        if(Auth::attempt(['user' => $request->input('user'), 'password' => $request->input('password')])){ 
            
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['user'] =  $user->user;
            $success['role_id'] =  $user->role_id;
            return response()->json(['data'=>$success],200); 
           
        } 
        else{ 
            return response()->json(['error'=>'Error en usuario o password'],404); 
        } 

       
    
       
    }
}
