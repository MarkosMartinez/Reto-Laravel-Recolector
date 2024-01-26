<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperaturaActual extends Model
{
    use HasFactory;

    protected $table = 'temperaturas_actuales';
    protected $primaryKey = 'nombre';
    protected $keyType = 'string';
    const UPDATED_AT = 'ultima_actualizacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'temperatura',
        'temperatura_real',
        'sensacion_termica',
        'humedad',
        'tiempo',
        'viento',
        'presion',
        'latitud',
        'longitud',
    ];
}