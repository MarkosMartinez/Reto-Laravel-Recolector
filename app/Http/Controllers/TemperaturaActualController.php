<?php

namespace App\Http\Controllers;

use App\Models\TemperaturaActual;
use App\Models\TemperaturaAnterior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\LOG;
use Carbon\Carbon;
use Config; 

class TemperaturaActualController extends Controller
{
    public function obtenerTemperaturas()
    {
        $ubicaciones = TemperaturaActual::All("nombre", "latitud", "longitud");
        foreach ($ubicaciones as $ubicacion) {
            $json = @file_get_contents('https://api.openweathermap.org/data/2.5/onecall?lat='.$ubicacion->latitud.'&lon='.$ubicacion->longitud.'&units=metric&appid='.config('api_tokens.token_openweathermap'));
            if (!$json) {
                return response()->json(['message'=>'error', 'codigo' => '500'], 500)->header('code', '500');
            }else{
                $data = json_decode($json, true);
                
                TemperaturaAnterior::create([
                    'nombre' => $ubicacion->nombre,
                    'temperatura' => $data["current"]["temp"],
                    'fecha' => now(),
                ]);

                $ubiActualizada = TemperaturaActual::find($ubicacion->nombre);
                $ubiActualizada->update([
                    'temperatura' => $data["current"]["temp"],
                    'temperatura_real' => $data["current"]["temp"],
                    'sensacion_termica' => $data["current"]["feels_like"],
                    'humedad' => $data["current"]["humidity"],
                    'viento' => $data["current"]["wind_speed"],
                    'presion' => $data["current"]["pressure"],
                    'tiempo' => $data["current"]["weather"][0]["main"],
                ]);
            }
        }
    }

    public function falsearTemperaturas()
    {
        $tiempoActual = Carbon::now();

        $ubicaciones = TemperaturaActual::All("nombre", "temperatura", "temperatura_real", "ultima_actualizacion");
        $diferenciaTiempo = $tiempoActual->diffInMinutes($ubicaciones[0]->ultima_actualizacion);
        if ($diferenciaTiempo > 15) {
            $this->obtenerTemperaturas();
        } else {
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
}