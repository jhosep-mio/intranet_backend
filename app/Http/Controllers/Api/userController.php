<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class userController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            "status" => "success",
            "message" => "Registrado Correctamente"
        ]);
    }

    public function login(Request $request) {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email", "=", $request->email)->first();
        if(isset($user->id)){
            if(Hash::check($request->password, $user->password)){
                //CREAMOS EL TOKEN
               $token = $user->createToken("auth_token")->plainTextToken;
               return response()->json([
                    "status" => "success",
                    "message" => "Usuario logueado exitosamente",
                    "acces_token" => $token,
                    "user" => $user 
                ]);
                //SI TODO ESTA CORRECTO
            }else{
                return response()->json([
                    "status" => "invalid",
                    "message" => "La contraseña es incorrecta"
                ]);
            }
        }else{
            return response()->json([
                "status" => "error",
                "message" => "El usuario no existe"
            ]);
        }
    }   

    public function userProfile(){
        return response()->json([
            "status" => "success",
            "message" => "Perfil del usuario",
            "user" => auth()->user()
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => "success",
            "message" => "Se cerro la session exitosamente",
        ]);
    }
}
