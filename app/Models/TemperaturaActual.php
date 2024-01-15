<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperaturaActual extends Model
{
    use HasFactory;

    protected $table = 'temperaturas_actuales';
    protected $primaryKey = 'nombre';
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
        'humedad',
        'tiempo',
        'viento',
        'latitud',
        'longitud',
    ];
}