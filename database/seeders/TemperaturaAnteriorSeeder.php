<?php

namespace Database\Seeders;
use App\Models\TemperaturaAnterior;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TemperaturaAnteriorSeeder extends Seeder
{
    private $rangosTemperaturas = [
        'Hondarribia' => [
            1 => [-3, 15],   // Enero
            2 => [0, 18],    // Febrero
            3 => [5, 20],    // Marzo
            4 => [8, 25],    // Abril
            5 => [15, 28],   // Mayo
            6 => [18, 33],   // Junio
            7 => [20, 37],   // Julio
            8 => [18, 32],   // Agosto
            9 => [15, 28],   // Septiembre
            10 => [10, 22],  // Octubre
            11 => [5, 18],   // Noviembre
            12 => [0, 15],   // Diciembre
        ],
        'Errenteria' => [
            1 => [-3, 15],   // Enero
            2 => [0, 18],    // Febrero
            3 => [5, 20],    // Marzo
            4 => [8, 25],    // Abril
            5 => [14, 27],   // Mayo
            6 => [17, 32],   // Junio
            7 => [20, 37],   // Julio
            8 => [16, 31],   // Agosto
            9 => [15, 28],   // Septiembre
            10 => [10, 20],  // Octubre
            11 => [5, 17],   // Noviembre
            12 => [0, 15],   // Diciembre
        ],
        'Donostia' => [
            1 => [-3, 15],   // Enero
            2 => [0, 18],    // Febrero
            3 => [5, 20],    // Marzo
            4 => [8, 25],    // Abril
            5 => [15, 29],   // Mayo
            6 => [18, 35],   // Junio
            7 => [20, 38],   // Julio
            8 => [18, 34],   // Agosto
            9 => [15, 29],   // Septiembre
            10 => [10, 22],  // Octubre
            11 => [5, 18],   // Noviembre
            12 => [0, 15],   // Diciembre
        ],
        'Bilbao' => [
            1 => [-3, 15],   // Enero
            2 => [0, 18],    // Febrero
            3 => [5, 17],    // Marzo
            4 => [8, 28],    // Abril
            5 => [15, 25],   // Mayo
            6 => [18, 33],   // Junio
            7 => [20, 37],   // Julio
            8 => [18, 35],   // Agosto
            9 => [10, 28],   // Septiembre
            10 => [10, 25],  // Octubre
            11 => [5, 18],   // Noviembre
            12 => [0, 10],   // Diciembre
        ],
        'Oymyakon' => [
            1 => [-50, -20],   // Enero
            2 => [-40, -15],    // Febrero
            3 => [-30, -05],    // Marzo
            4 => [-20, 05],    // Abril
            5 => [-10, 15],   // Mayo
            6 => [0, 25],   // Junio
            7 => [10, 30],   // Julio
            8 => [20, 35],   // Agosto
            9 => [0, 40],   // Septiembre
            10 => [-10, 15],  // Octubre
            11 => [-25, 01],   // Noviembre
            12 => [-35, -15],   // Diciembre
        ],
    ];
    

    public function run()
    {
        $ciudades = ['Hondarribia', 'Errenteria', 'Donostia', 'Bilbao', 'Oymyakon'];

        $startDate = Carbon::create(2023, 1, 1, 0, 0, 0);
        $endDate = Carbon::create(2024, 1, 31, 11, 00, 0);

        $currentDate = clone $startDate;

        while ($currentDate <= $endDate) {
            foreach ($ciudades as $ciudad) {
                $temperatura = $this->generarTemperatura($currentDate->month, $ciudad);

                TemperaturaAnterior::create([
                    'nombre' => $ciudad,
                    'temperatura' => $temperatura,
                    'fecha' => $currentDate,
                ]);
            }

            $currentDate->addMinutes(15);
        }
    }

    private function generarTemperatura($mes, $ciudad)
    {
        $min = $this->rangosTemperaturas[$ciudad][$mes][0];
        $max = $this->rangosTemperaturas[$ciudad][$mes][1];

        return mt_rand($min, $max);
    }
}
