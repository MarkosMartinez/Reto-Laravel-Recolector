<?php

namespace App\Http\Controllers;

use App\Models\TemperaturaActual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\LOG;
use Config; 

class TemperaturaActualController extends Controller
{
    public function obtenerTemperaturas()
    {
        // TemperaturaActual::create([
        //     'nombre' => 'Hondarribia',
        //     'temperatura' => 10.2,
        //     'temperatura_real' => 10,
        //     'humedad' => 0,
        //     'probabilidad_lluvia' => 0,
        //     'tiempo' => 'nublado',
        //     'latitud' => 43.3671,
        //     'longitud' => -1.7972,
        // ]);
        $ubicaciones = TemperaturaActual::All("nombre", "latitud", "longitud");
        foreach ($ubicaciones as $ubicacion) {
            $json = @file_get_contents('https://api.openweathermap.org/data/2.5/onecall?lat='.$ubicacion->latitud.'&lon='.$ubicacion->longitud.'&units=metric&appid='.config('api_tokens.token_openweathermap'));
            if (!$json) {
                return response()->json(['message'=>'error', 'codigo' => '500'], 500)->header('code', '500');
            }else{
                //return json_decode($json);
                $data = json_decode($json, true);
                $ubiActualizada = TemperaturaActual::find($ubicacion->nombre);
                $ubiActualizada->update([
                    'temperatura' => $data["current"]["temp"],
                    'temperatura_real' => $data["current"]["temp"],
                    'humedad' => $data["current"]["humidity"],
                    'viento' => $data["current"]["wind_speed"],
                    'tiempo' => $data["current"]["weather"][0]["main"],
                ]);
            }
        }
    }

    public function falsearTemperaturas()
    {
        $ubicaciones = TemperaturaActual::All("nombre", "temperatura", "temperatura_real");
        foreach ($ubicaciones as $ubicacion) {
                $ubiActualizada = TemperaturaActual::find($ubicacion->nombre);
                if($ubicacion->temperatura + 0.2 >= $ubicacion->temperatura_real + 1){
                $ubiActualizada->update([
                    'temperatura' => $ubicacion->temperatura_real - 0.9
                ]);
                }else{
                    $ubiActualizada->update([
                        'temperatura' => $ubicacion->temperatura + 0.2
                    ]); 
                }
        }
    }
}