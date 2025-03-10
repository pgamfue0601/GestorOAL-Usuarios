<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosUsuarios extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentosUsuariosFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo_documento',
        'ruta_documento',
        'usuario_id',
    ];

    public function usuario() {
        return $this->belongsTo(UsuarioOAL::class);
    }
    
    public static function getDocumentsByUser($userId) {
        return self::where('usuario_id', $userId)->get();
    }
}
