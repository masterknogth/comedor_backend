<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AssistController;
use App\Http\Controllers\api\PersonalController;
use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\api\ReportController;
use App\Http\Controllers\api\PersonalImageController;
use App\Http\Controllers\api\StudentImageController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('test/{id}', 'testApi');
});
Route::middleware('auth:sanctum')->group( function () {
    Route::post('readCarnet', [AssistController::class, 'readCarnet']);
    Route::get('count', [AssistController::class, 'count']);

    Route::post('import', [PersonalController::class, 'import']);
    Route::post('listarPersonal', [PersonalController::class, 'index']);
    Route::post('storePersonal', [PersonalController::class, 'store']);
    Route::put('updatePersonal/{id}', [PersonalController::class, 'update']);
    Route::delete('deletePersonal/{id}', [PersonalController::class, 'destroy']);
   

    Route::post('listarEstudiantes', [StudentController::class, 'index']);
    Route::post('storeEstudiante', [StudentController::class, 'store']);
    Route::put('updateEstudiante/{id}', [StudentController::class, 'update']);
    Route::delete('deleteEstudiante/{id}', [StudentController::class, 'destroy']);
    

    Route::post('listarReportes', [ReportController::class, 'index']);
    Route::post('countReport', [ReportController::class, 'countReport']);

    Route::post('listarFotosPersonal', [PersonalImageController::class, 'index']);
    Route::post('impotarFotosPersonal', [PersonalImageController::class, 'impotarPersonalFoto']);

    Route::post('listarFotosEstudiante', [StudentImageController::class, 'index']);
    Route::post('impotarFotosEstudiante', [StudentImageController::class, 'impotarEstudianteFoto']);
    
});