<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class odontologos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_rol', 
        'clinica', 
        'cop', 
        'c_bancaria', 
        'cci',
        'nombre_banco', 
        'nombres',
        'apellido_p',
        'apellido_m',
        'f_nacimiento',
        'tipo_documento_paciente_odontologo',
        'numero_documento_paciente_odontologo',
        'celular',
        'correo',
        'genero',
    ];

}
