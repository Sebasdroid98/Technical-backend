<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    use HasFactory;

    /* Se define el nombre de la llave primaria */
    protected $primaryKey = 'id_libro';

    /**
     * Definimos los atributos que podran se asignados masivamente
     */
    protected $fillable = [
        'nombre_libro'
    ];

    /**
     * Mutador para almacenar el nombre del libro en mayúsculas
     */
    // public function setNombreLibroAttribute($value)
    // {
    //     $this->attributes['nombre_libro'] = strtoupper($value);
    // }
}
