<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Clinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicaController extends Controller
{
    public function index(){
        $registros = Clinica::where('id', '!=', '0')->get();
        return $registros;
    }

    public function store2(Request $request){
        $saveclinica = new Clinica();

        $validatedData = $request->validate([
            'nombre'=>'required|string',
            'direccion'=>'required',
            'referencia' =>'string|nullable',
            'telefono' =>'nullable|integer|min:1000000|max:999999999',
            'celular' =>'required|numeric|min:100000000|max:999999999',
        ]);

        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);

        $saveclinica->nombre = $validatedData['nombre'];
        $saveclinica->direccion = $validatedData['direccion'];
        $saveclinica->referencia = $validatedData['referencia'];
        $saveclinica->telefono = $validatedData['telefono'];
        $saveclinica->celular = $validatedData['celular'];
        
        $result = $saveclinica->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }
    
    public function show($id){
        $verClinica = Clinica::find($id);
        return $verClinica;
    }


    public function update(Request $request, $id){
        $updateClinica= Clinica::findOrFail($id);

        $validatedData = $request->validate([
            'nombre'=>'required|string',
            'direccion'=>'required',
            'referencia' =>'string|nullable',
            'telefono' =>'nullable|integer|min:1000000|max:999999999',
            'celular' =>'required|numeric|min:100000000|max:999999999',
        ]);

        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);

        $updateClinica->nombre = $validatedData['nombre'];
        $updateClinica->direccion = $validatedData['direccion'];
        $updateClinica->referencia = $validatedData['referencia'];
        $updateClinica->telefono = $validatedData['telefono'];
        $updateClinica->celular = $validatedData['celular'];

        $result =$updateClinica->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

    public function destroy($id){
        $result = Clinica::destroy($id);

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }

    }
}
