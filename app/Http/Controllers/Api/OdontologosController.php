<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\odontologos;
use Illuminate\Http\Request;

class OdontologosController extends Controller
{
    public function index(){
        $odontologos = odontologos::all();
        return $odontologos;
    }

    public function store(Request $request){
        $saveOdontologos = new odontologos();

        $validatedData = $request->validate([
            'id_rol'=>'required|numeric',
            'clinica'=>'numeric',
            'cop'=>'required|numeric|min:10000 |max:9999999999',
            'c_bancaria'=>'string|nullable',
            'cci'=>'nullable|string ',
            'nombre_banco'=>'string|nullable',
            'nombres'=>'required|regex:/^[^0-9]+$/',
            'apellido_p'=>'required|regex:/^[^0-9]+$/',
            'apellido_m'=>'required|regex:/^[^0-9]+$/',
            'f_nacimiento'=>'required|string',
            'tipo_documento_paciente_odontologo'=>'required|numeric',
            'numero_documento_paciente_odontologo'=>'required|string',
            'celular' =>'required|numeric|min:100000000 |max:999999999',
            'correo'=>'required|string',
            'genero'=>'required|numeric',
        ]);

        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);

        $saveOdontologos->id_rol = $validatedData['id_rol'];
        $saveOdontologos->clinica = $validatedData['clinica'];
        $saveOdontologos->cop = $validatedData['cop'];

        $saveOdontologos->c_bancaria = $validatedData['c_bancaria'];
        $saveOdontologos->cci = $validatedData['cci'];
        $saveOdontologos->nombre_banco = $validatedData['nombre_banco'];

        $saveOdontologos->nombres = $validatedData['nombres'];
        $saveOdontologos->apellido_p = $validatedData['apellido_p'];
        $saveOdontologos->apellido_m = $validatedData['apellido_m'];
        $saveOdontologos->f_nacimiento = $validatedData['f_nacimiento'];
        $saveOdontologos->tipo_documento_paciente_odontologo = $validatedData['tipo_documento_paciente_odontologo'];
        $saveOdontologos->numero_documento_paciente_odontologo = $validatedData['numero_documento_paciente_odontologo'];
        $saveOdontologos->celular = $validatedData['celular'];
        $saveOdontologos->correo = $validatedData['correo'];
        $saveOdontologos->genero = $validatedData['genero'];

        $result = $saveOdontologos->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

    public function show($id){
        $verOdontologo = odontologos::find($id);
        return $verOdontologo;
    }

    public function update(Request $request, $id){
        $updateOdontologo= odontologos::findOrFail($id);

        $validatedData = $request->validate([
            'id_rol'=>'required|numeric',
            'clinica'=>'numeric',
            'cop'=>'required|numeric|min:10000 |max:9999999999',
            'c_bancaria'=>'string|nullable',
            'cci'=>'string|nullable',
            'nombre_banco'=>'string|nullable',
            'nombres'=>'required|regex:/^[^0-9]+$/',
            'apellido_p'=>'required|regex:/^[^0-9]+$/',
            'apellido_m'=>'required|regex:/^[^0-9]+$/',
            'f_nacimiento'=>'required|string',
            'tipo_documento_paciente_odontologo'=>'required|numeric',
            'numero_documento_paciente_odontologo'=>'required|string',
            'celular' =>'required|numeric|min:100000000 |max:999999999',
            'correo'=>'required|string',
            'genero'=>'required|numeric',
        ]);

        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);

        $updateOdontologo->id_rol = $validatedData['id_rol'];
        $updateOdontologo->clinica = $validatedData['clinica'];
        $updateOdontologo->cop = $validatedData['cop'];

        $updateOdontologo->c_bancaria = $validatedData['c_bancaria'];
        $updateOdontologo->cci = $validatedData['cci'];
        $updateOdontologo->nombre_banco = $validatedData['nombre_banco'];

        $updateOdontologo->nombres = $validatedData['nombres'];
        $updateOdontologo->apellido_p = $validatedData['apellido_p'];
        $updateOdontologo->apellido_m = $validatedData['apellido_m'];
        $updateOdontologo->f_nacimiento = $validatedData['f_nacimiento'];
        $updateOdontologo->tipo_documento_paciente_odontologo = $validatedData['tipo_documento_paciente_odontologo'];
        $updateOdontologo->numero_documento_paciente_odontologo = $validatedData['numero_documento_paciente_odontologo'];
        $updateOdontologo->celular = $validatedData['celular'];
        $updateOdontologo->correo = $validatedData['correo'];
        $updateOdontologo->genero = $validatedData['genero'];


        $result =$updateOdontologo->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }


    public function destroy($id){
        $result = odontologos::destroy($id);
            if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

}
