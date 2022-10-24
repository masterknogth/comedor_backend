<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    public function changeTemplate(Request $request,$id)
    {
        
        Configuration::where('codigo','!=', $id)->update([
            'status' => '0'
        ]);
        Configuration::where('codigo', $id)->update([
            'status' => '1'
        ]);
        return response()->json(['data'=>'cambio a: '.$id],200); 
    }

    public function getTemplate()
    {
        $template = Configuration::where('status', 1)->first();
        return response()->json(['data'=>$template->codigo],200); 
    }
}
