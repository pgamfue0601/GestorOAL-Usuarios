<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioOAL extends Model
{
    /** @use HasFactory<\Database\Factories\UsuarioOALFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'sexo',
        'dni',
        'edad',
        'fecha_activacion',
        'telefono',
        'ocupacion',
        'ocupacion2',
        'ocupacion3',
        'discapacidad',
        'nivel_estudios',
        'especialidad',
        'disponibilidad',
        'carnet',
        'vehiculo',
        'localidad',
        'observaciones',
        'programa_oal',
        'año_programa_oal',
        'programa_oal_2',
        'año_programa_oal_2',
        'programa_oal_3',
        'año_programa_oal_3',
    ];

    public function documents() {
        return $this->hasMany(DocumentosUsuarios::class);
    }

    public static function findFullNameByID($id){
        $usuario = UsuarioOAL::find($id);
        return $usuario ? "{$usuario->dni}-{$usuario->nombre} {$usuario->apellidos}" : null;
    }
}
