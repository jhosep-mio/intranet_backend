<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\catservicios;
use Illuminate\Http\Request;

class catserviciosController extends Controller
{
    public function index(){
        $catservicios = catservicios::all();
        return $catservicios;
    }

    public function store(Request $request){
        $saveCatServicios = new catservicios();

        $request->validate([
            'nombre'=>'required|string',
        ]);

        $saveCatServicios->nombre = $request->nombre;
        
        $result = $saveCatServicios->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }
    
    public function show($id){
        $vetCatServicios = catservicios::find($id);
        return $vetCatServicios;
    }


    public function update(Request $request, $id){
        $updateCatServicios= catservicios::findOrFail($id);

         $request->validate([
            'nombre'=>'required|string',
        ]);

        $updateCatServicios->nombre = $request->nombre;

        $result =$updateCatServicios->save();

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }
    }

    public function destroy($id){
        $result = catservicios::destroy($id);

        if($result){
            return response()->json(['status'=>"success"]);
        }else {
            return response()->json(['status'=>"error"]);
        }

    }
}
