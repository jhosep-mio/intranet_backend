<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pacientes extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_rol', 
        'nombres',
        'apellido_p',
        'apellido_m',
        'f_nacimiento',
        'nombre_apoderado',
        'tipo_documento_apoderado',
        'documento_apoderado',
        'tipo_documento_paciente_odontologo',
        'numero_documento_paciente_odontologo',
        'celular',
        'correo',
        'genero',
        'embarazada',
        'enfermedades',
        'discapacidades',
        'paciente_especial'];
}
