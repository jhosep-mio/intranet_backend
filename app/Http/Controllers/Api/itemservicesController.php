<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\itemservices;
use Illuminate\Http\Request;

class itemservicesController extends Controller
{
    public function index(){
        $items = itemservices::join('catservicios', 'itemservices.id_servicio', '=', 'catservicios.id')
                            ->select(
                                'itemservices.*', 
                                'catservicios.nombre as servicio'
                                )
                            ->get();
        return $items;
    }

    public function store(Request $request){
        $saveItem = new itemservices();

        $validatedData = $request->validate([
            'id_servicio'=>'required|integer',
            'nombre'=>'required|string',
            'precio_venta' =>'required|numeric',
            'comision_impreso' =>'nullable|numeric',
            'comision_digital' =>'nullable|numeric',
            'insumos1' =>'nullable|numeric',
            'insumos2' =>'nullable|numeric',
            'insumos3' =>'nullable|numeric',
            'insumos4' =>'nullable|numeric',
        ]);

        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);

        $saveItem->id_servicio = $validatedData['id_servicio'];
        $saveItem->nombre = $validatedData['nombre'];
        $saveItem->precio_venta = $validatedData['precio_venta'];
        $saveItem->comision_impreso = $validatedData['comision_impreso'];
        $saveItem->comision_digital = $validatedData['comision_digital'];
        $saveItem->insumos1 = $validatedData['insumos1'];
        $saveItem->insumos2 = $validatedData['insumos2'];
        $saveItem->insumos3 = $validatedData['insumos3'];
        $saveItem->insumos4 = $validatedData['insumos4'];
        
        $result = $saveItem->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

    public function show($id){
        $verServicio = itemservices::find($id);
        return $verServicio;
    }

    public function update(Request $request, $id){
        $updateItem= itemservices::findOrFail($id);

        $validatedData = $request->validate([
            'id_servicio'=>'required|integer',
            'nombre'=>'required|string',
            'precio_venta' =>'required|numeric',
            'comision_impreso' =>'nullable|numeric',
            'comision_digital' =>'nullable|numeric',
            'insumos1' =>'nullable|numeric',
            'insumos2' =>'nullable|numeric',
            'insumos3' =>'nullable|numeric',
            'insumos4' =>'nullable|numeric',
        ]);

        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);


        $updateItem->id_servicio = $validatedData['id_servicio'];
        $updateItem->nombre = $validatedData['nombre'];
        $updateItem->precio_venta = number_format($validatedData['precio_venta'], 2);
        $updateItem->comision_impreso = $validatedData['comision_impreso'];
        $updateItem->comision_digital = $validatedData['comision_digital'];
        $updateItem->insumos1 = $validatedData['insumos1'];
        $updateItem->insumos2 = $validatedData['insumos2'];
        $updateItem->insumos3 = $validatedData['insumos3'];
        $updateItem->insumos4 = $validatedData['insumos4'];

        $result =$updateItem->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

    public function destroy($id){
        $result = itemservices::destroy($id);

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }

    }

}
