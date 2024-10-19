<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_libro';

    /**
     * Definimos los atributos que podran se asignados masivamente
     */
    protected $fillable = [
        'nombre_libro'
    ];
}
