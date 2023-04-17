<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ordenes;
use Illuminate\Http\Request;

class OrdenesController extends Controller
{
    public function index(){
        $ordenes = ordenes::join('pacientes', 'ordenes.id_paciente', '=', 'pacientes.id')
                            ->join('odontologos', 'ordenes.id_odontologo', '=', 'odontologos.id')
                            ->select(
                                'ordenes.*', 
                                'pacientes.nombres as paciente', 
                                'pacientes.tipo_documento_paciente_odontologo as TipoDocumentoPaciente',
                                'pacientes.numero_documento_paciente_odontologo  as documentoPaciente',
                                'odontologos.nombres as odontologo',
                                'odontologos.cop as copOdontologo'
                                )
                            ->get();
        return $ordenes;
    }

    public function store(Request $request){

        $saveOrdenVirtual = new ordenes();

        $validatedData = $request->validate([
            'id_paciente'=>'required|numeric',
            'id_odontologo'=>'required|numeric',
            'consulta'=> 'required|string',

            'box18'=>'boolean',
            'box17'=>'boolean',
            'box16'=>'boolean',
            'box15'=>'boolean',
            'box14'=>'boolean',
            'box13'=>'boolean',
            'box12'=>'boolean',
            'box11'=>'boolean',
            'box21'=>'boolean',
            'box22'=>'boolean',
            'box23'=>'boolean',
            'box24'=>'boolean',
            'box25'=>'boolean',
            'box26'=>'boolean',
            'box27'=>'boolean',
            'box28'=>'boolean',
            'box48'=>'boolean',
            'box47'=>'boolean',
            'box46'=>'boolean',
            'box45'=>'boolean',
            'box44'=>'boolean',
            'box43'=>'boolean',
            'box42'=>'boolean',
            'box41'=>'boolean',
            'box31'=>'boolean',
            'box32'=>'boolean',
            'box33'=>'boolean',
            'box34'=>'boolean',
            'box35'=>'boolean',
            'box36'=>'boolean',
            'box37'=>'boolean',
            'box38'=>'boolean',

            'siConGuias'=>'boolean',
            'noConGuias'=>'boolean',

            'listaItems'=>'required|string',
            'metodoPago'=>'nullable|numeric',
            'precio_final'=>'required|numeric',

            'otrosAnalisis'=>'nullable|string',
            'estado'=>'required|numeric',
        ]);

        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);


        $saveOrdenVirtual->id_paciente = $validatedData['id_paciente'];
        $saveOrdenVirtual->id_odontologo = $validatedData['id_odontologo'];
        $saveOrdenVirtual->consulta = $validatedData['consulta'];


        $saveOrdenVirtual->box18 = $validatedData['box18'];
        $saveOrdenVirtual->box17 = $validatedData['box17'];
        $saveOrdenVirtual->box16 = $validatedData['box16'];
        $saveOrdenVirtual->box15 = $validatedData['box15'];
        $saveOrdenVirtual->box14 = $validatedData['box14'];
        $saveOrdenVirtual->box13 = $validatedData['box13'];
        $saveOrdenVirtual->box12 = $validatedData['box12'];
        $saveOrdenVirtual->box11 = $validatedData['box11'];

        $saveOrdenVirtual->box21 = $validatedData['box21'];
        $saveOrdenVirtual->box22 = $validatedData['box22'];
        $saveOrdenVirtual->box23 = $validatedData['box23'];
        $saveOrdenVirtual->box24 = $validatedData['box24'];
        $saveOrdenVirtual->box25 = $validatedData['box25'];
        $saveOrdenVirtual->box26 = $validatedData['box26'];
        $saveOrdenVirtual->box27 = $validatedData['box27'];
        $saveOrdenVirtual->box28 = $validatedData['box28'];

        
        $saveOrdenVirtual->box48 = $validatedData['box48'];
        $saveOrdenVirtual->box47 = $validatedData['box47'];
        $saveOrdenVirtual->box46 = $validatedData['box46'];
        $saveOrdenVirtual->box45 = $validatedData['box45'];
        $saveOrdenVirtual->box44 = $validatedData['box44'];
        $saveOrdenVirtual->box43 = $validatedData['box43'];
        $saveOrdenVirtual->box42 = $validatedData['box42'];
        $saveOrdenVirtual->box41 = $validatedData['box41'];

        $saveOrdenVirtual->box31 = $validatedData['box31'];
        $saveOrdenVirtual->box32 = $validatedData['box32'];
        $saveOrdenVirtual->box33 = $validatedData['box33'];
        $saveOrdenVirtual->box34 = $validatedData['box34'];
        $saveOrdenVirtual->box35 = $validatedData['box35'];
        $saveOrdenVirtual->box36 = $validatedData['box36'];
        $saveOrdenVirtual->box37 = $validatedData['box37'];
        $saveOrdenVirtual->box38 = $validatedData['box38'];

        $saveOrdenVirtual->siConGuias = $validatedData['siConGuias'];
        $saveOrdenVirtual->noConGuias = $validatedData['noConGuias'];

        $saveOrdenVirtual->listaItems = $validatedData['listaItems'];
        $saveOrdenVirtual->metodoPago = $validatedData['metodoPago'];
        $saveOrdenVirtual->precio_final = $validatedData['precio_final'];

        $saveOrdenVirtual->otrosAnalisis = $validatedData['otrosAnalisis'];
        $saveOrdenVirtual->estado = $validatedData['estado'];

        $result = $saveOrdenVirtual->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

    public function show($id){
        $verOrden = ordenes::find($id);

        if($verOrden){
            return response()->json([
                'status'=>"success",
                'verOrden'=>$verOrden
            ]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

    public function update(Request $request, $id){

        $updateOrdenVirtual= ordenes::findOrFail($id);

        $validatedData = $request->validate([
            'id_paciente'=>'required|numeric',
            'id_odontologo'=>'required|numeric',
            'consulta'=> 'required|string',

            'box18'=>'boolean',
            'box17'=>'boolean',
            'box16'=>'boolean',
            'box15'=>'boolean',
            'box14'=>'boolean',
            'box13'=>'boolean',
            'box12'=>'boolean',
            'box11'=>'boolean',
            'box21'=>'boolean',
            'box22'=>'boolean',
            'box23'=>'boolean',
            'box24'=>'boolean',
            'box25'=>'boolean',
            'box26'=>'boolean',
            'box27'=>'boolean',
            'box28'=>'boolean',
            'box48'=>'boolean',
            'box47'=>'boolean',
            'box46'=>'boolean',
            'box45'=>'boolean',
            'box44'=>'boolean',
            'box43'=>'boolean',
            'box42'=>'boolean',
            'box41'=>'boolean',
            'box31'=>'boolean',
            'box32'=>'boolean',
            'box33'=>'boolean',
            'box34'=>'boolean',
            'box35'=>'boolean',
            'box36'=>'boolean',
            'box37'=>'boolean',
            'box38'=>'boolean',

            'siConGuias'=>'boolean',
            'noConGuias'=>'boolean',

            'listaItems'=>'required|string',
            'metodoPago'=>'nullable|numeric',
            'precio_final'=>'required|numeric',

            'otrosAnalisis'=>'nullable|string',
            'estado'=>'required|numeric',
        ]);

        $validatedData = array_map(function ($value) {
            return $value === 'null' ? null : $value;
        }, $validatedData);

        $updateOrdenVirtual->id_paciente = $validatedData['id_paciente'];
        $updateOrdenVirtual->id_odontologo = $validatedData['id_odontologo'];
        $updateOrdenVirtual->consulta = $validatedData['consulta'];


        $updateOrdenVirtual->box18 = $validatedData['box18'];
        $updateOrdenVirtual->box17 = $validatedData['box17'];
        $updateOrdenVirtual->box16 = $validatedData['box16'];
        $updateOrdenVirtual->box15 = $validatedData['box15'];
        $updateOrdenVirtual->box14 = $validatedData['box14'];
        $updateOrdenVirtual->box13 = $validatedData['box13'];
        $updateOrdenVirtual->box12 = $validatedData['box12'];
        $updateOrdenVirtual->box11 = $validatedData['box11'];

        $updateOrdenVirtual->box21 = $validatedData['box21'];
        $updateOrdenVirtual->box22 = $validatedData['box22'];
        $updateOrdenVirtual->box23 = $validatedData['box23'];
        $updateOrdenVirtual->box24 = $validatedData['box24'];
        $updateOrdenVirtual->box25 = $validatedData['box25'];
        $updateOrdenVirtual->box26 = $validatedData['box26'];
        $updateOrdenVirtual->box27 = $validatedData['box27'];
        $updateOrdenVirtual->box28 = $validatedData['box28'];

        
        $updateOrdenVirtual->box48 = $validatedData['box48'];
        $updateOrdenVirtual->box47 = $validatedData['box47'];
        $updateOrdenVirtual->box46 = $validatedData['box46'];
        $updateOrdenVirtual->box45 = $validatedData['box45'];
        $updateOrdenVirtual->box44 = $validatedData['box44'];
        $updateOrdenVirtual->box43 = $validatedData['box43'];
        $updateOrdenVirtual->box42 = $validatedData['box42'];
        $updateOrdenVirtual->box41 = $validatedData['box41'];

        $updateOrdenVirtual->box31 = $validatedData['box31'];
        $updateOrdenVirtual->box32 = $validatedData['box32'];
        $updateOrdenVirtual->box33 = $validatedData['box33'];
        $updateOrdenVirtual->box34 = $validatedData['box34'];
        $updateOrdenVirtual->box35 = $validatedData['box35'];
        $updateOrdenVirtual->box36 = $validatedData['box36'];
        $updateOrdenVirtual->box37 = $validatedData['box37'];
        $updateOrdenVirtual->box38 = $validatedData['box38'];

        $updateOrdenVirtual->siConGuias = $validatedData['siConGuias'];
        $updateOrdenVirtual->noConGuias = $validatedData['noConGuias'];

        $updateOrdenVirtual->listaItems = $validatedData['listaItems'];
        $updateOrdenVirtual->metodoPago = $validatedData['metodoPago'];
        $updateOrdenVirtual->precio_final = $validatedData['precio_final'];

        $updateOrdenVirtual->otrosAnalisis = $validatedData['otrosAnalisis'];
        $updateOrdenVirtual->estado = $validatedData['estado'];

        $result =$updateOrdenVirtual->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }
}
