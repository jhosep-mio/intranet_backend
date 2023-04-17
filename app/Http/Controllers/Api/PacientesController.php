<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\pacientes;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    public function index(){
        $pacientes = pacientes::all();
        return $pacientes;
    }

    public function store(Request $request){
        $savePaciente = new pacientes();

        $validatedData = $request->validate([
            'id_rol'=>'required|numeric',
            'nombres'=>'required|regex:/^[^0-9]+$/',
            'apellido_p'=>'required|regex:/^[^0-9]+$/',
            'apellido_m'=>'required|regex:/^[^0-9]+$/',
            'f_nacimiento'=>'required|string',

            'nombre_apoderado'=>'nullable|regex:/^[^0-9]+$/',
            
            'tipo_documento_apoderado'=>'nullable|integer',
            
            'documento_apoderado'=>'string|nullable',
            'tipo_documento_paciente_odontologo'=>'required|numeric',
            'numero_documento_paciente_odontologo'=>'required|string',
            'celular' =>'required|numeric|min:100000000 |max:999999999',
            'correo'=>'required|string',
            'genero'=>'required|numeric',
            'embarazada'=>'numeric|nullable',
            'enfermedades'=>'string|nullable',
            'discapacidades'=>'string|nullable',
            'paciente_especial'=>'string|nullable',
        ]);


        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);



        $savePaciente->id_rol = $validatedData['id_rol'];
        $savePaciente->nombres = $validatedData['nombres'];
        $savePaciente->apellido_p = $validatedData['apellido_p'];
        $savePaciente->apellido_m = $validatedData['apellido_m'];
        $savePaciente->f_nacimiento = $validatedData['f_nacimiento'];
        $savePaciente->nombre_apoderado = $validatedData['nombre_apoderado'];
        $savePaciente->tipo_documento_apoderado = $validatedData['tipo_documento_apoderado'];
        $savePaciente->documento_apoderado = $validatedData['documento_apoderado'];
        $savePaciente->tipo_documento_paciente_odontologo = $validatedData['tipo_documento_paciente_odontologo'];
        $savePaciente->numero_documento_paciente_odontologo = $validatedData['numero_documento_paciente_odontologo'];
        $savePaciente->celular = $validatedData['celular'];
        $savePaciente->correo = $validatedData['correo'];
        $savePaciente->genero = $validatedData['genero'];
        $savePaciente->embarazada = $validatedData['embarazada'];
        $savePaciente->enfermedades = $validatedData['enfermedades'];
        $savePaciente->discapacidades = $validatedData['discapacidades'];
        $savePaciente->paciente_especial = $validatedData['paciente_especial'];

        $result = $savePaciente->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

    public function eyes(Request $request) {

        $request->validate([
            "tipo_documento_paciente_odontologo" => "required|numeric",
            "numero_documento_paciente_odontologo" => "required|string"
        ]);

        $paciente = pacientes::where("numero_documento_paciente_odontologo", "=", $request->numero_documento_paciente_odontologo)->first();
        if(isset($paciente->id)){
            if($request->tipo_documento_paciente_odontologo == $paciente->tipo_documento_paciente_odontologo){
                //CREAMOS EL TOKEN
               return response()->json([
                    "status" => "success",
                    "message" => "Paciente encontrado",
                    "paciente" => $paciente 
                ]);
                //SI TODO ESTA CORRECTO
            }else{
                return response()->json([
                    "status" => "invalid",
                    "message" => "El tipo de documento es incorrecto"
                ]);
            }
        }else{
            return response()->json([
                "status" => "error",
                "message" => "El paciente no existe"
            ]);
        }
    }   

    public function show($id){
        $verPaciente = pacientes::find($id);
        return $verPaciente;
    }

    public function update(Request $request, $id){
        $updatePaciente= pacientes::findOrFail($id);

        $validatedData = $request->validate([
            'id_rol'=>'required|numeric',
            'nombres'=>'required|regex:/^[^0-9]+$/',
            'apellido_p'=>'required|regex:/^[^0-9]+$/',
            'apellido_m'=>'required|regex:/^[^0-9]+$/',
            'f_nacimiento'=>'required|string',
            'nombre_apoderado'=>'nullable|regex:/^[^0-9]+$/',
            'tipo_documento_apoderado'=>'nullable|integer',
            'documento_apoderado'=>'string|nullable',
            'tipo_documento_paciente_odontologo'=>'required|numeric',
            'numero_documento_paciente_odontologo'=>'required|string',
            'celular' =>'required|numeric|min:100000000 |max:999999999',
            'correo'=>'required|string',
            'genero'=>'required|numeric',
            'embarazada'=>'numeric|nullable',
            'enfermedades'=>'string|nullable',
            'discapacidades'=>'string|nullable',
            'paciente_especial'=>'string|nullable',
        ]);

        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);


        $updatePaciente->id_rol = $validatedData['id_rol'];
        $updatePaciente->nombres = $validatedData['nombres'];
        $updatePaciente->apellido_p = $validatedData['apellido_p'];
        $updatePaciente->apellido_m = $validatedData['apellido_m'];
        $updatePaciente->f_nacimiento = $validatedData['f_nacimiento'];
        $updatePaciente->nombre_apoderado = $validatedData['nombre_apoderado'];
        $updatePaciente->tipo_documento_apoderado = $validatedData['tipo_documento_apoderado'];
        $updatePaciente->documento_apoderado = $validatedData['documento_apoderado'];
        $updatePaciente->tipo_documento_paciente_odontologo = $validatedData['tipo_documento_paciente_odontologo'];
        $updatePaciente->numero_documento_paciente_odontologo = $validatedData['numero_documento_paciente_odontologo'];
        $updatePaciente->celular = $validatedData['celular'];
        $updatePaciente->correo = $validatedData['correo'];
        $updatePaciente->genero = $validatedData['genero'];
        $updatePaciente->embarazada = $validatedData['embarazada'];
        $updatePaciente->enfermedades = $validatedData['enfermedades'];
        $updatePaciente->discapacidades = $validatedData['discapacidades'];
        $updatePaciente->paciente_especial = $validatedData['paciente_especial'];


        $result =$updatePaciente->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

    public function destroy($id){
        $result = pacientes::destroy($id);
            if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

  
}
