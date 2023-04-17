<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemservices extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_servicio', 
        'nombre', 
        'precio_venta', 
        'comision_impreso', 
        'comision_digital',
        'insumos1', 
        'insumos2',
        'insumos3',
        'insumos4',
    ];
}
