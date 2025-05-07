<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (! $usuario || ! Hash::check($request->password, $usuario->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $token = $usuario->createToken('api_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'usuario' => $usuario
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dnie' => ['required', 'regex:/^([XYZ]?\d{7,8}[A-Z])$/', 'unique:usuarios,dnie'],
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'telefono' => ['required', 'regex:/^[679]\d{8}$/'],
            'rol' => 'in:usuario',
            'carrito' => 'nullable|json',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['rol'] = 'usuario';

        $usuario = Usuario::create($data);
        $token = $usuario->createToken('api_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'usuario' => $usuario
        ], 201);
    }


    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
