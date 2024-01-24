<?php

namespace Database\Seeders;
use App\Models\TemperaturaAnterior;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TemperaturaAnteriorSeeder extends Seeder
{
    private $rangosTemperaturas = [
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
    ];
    

    public function run()
    {
        $ciudades = ['Hondarribia', 'Errenteria', 'Donostia', 'Bilbao'];

        $startDate = Carbon::create(2023, 1, 1, 0, 0, 0);
        $endDate = Carbon::create(2023, 12, 31, 23, 45, 0);

        $currentDate = clone $startDate;

        while ($currentDate <= $endDate) {
            foreach ($ciudades as $ciudad) {
                $temperatura = $this->generarTemperatura($currentDate->month);

                TemperaturaAnterior::create([
                    'nombre' => $ciudad,
                    'temperatura' => $temperatura,
                    'fecha' => $currentDate,
                ]);
            }

            $currentDate->addMinutes(15);
        }
    }

    private function generarTemperatura($mes)
    {
        $min = $this->rangosTemperaturas[$mes][0];
        $max = $this->rangosTemperaturas[$mes][1];

        return mt_rand($min, $max);
    }
}
