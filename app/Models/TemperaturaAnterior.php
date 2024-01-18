<?php

namespace App\Models;

use Database\Factories\TemperaturaAnteriorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperaturaAnterior extends Model
{
    use HasFactory;
    
    protected $table = 'temperaturas_anteriores';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'temperatura',
        'humedad',
        'tiempo',
        'viento',
        'fecha'
    ];

}
