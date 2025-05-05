<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dnie' => [
                'required',
                'regex:/^([XYZ]?\d{7,8}[A-Z])$/',
                'unique:usuarios,dnie',
            ],
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'telefono' => ['required', 'regex:/^[679]\d{8}$/'],
            'rol' => 'required|in:admin,usuario',
            'carrito' => 'nullable|string',
        ]);
        
        $data['password'] = Hash::make($data['password']);

        $usuario = Usuario::create($data);

        return response()->json($usuario, 201);
    }

    public function show(Usuario $usuario)
    {
        return response()->json($usuario);
    }

    public function update(Request $request, Usuario $usuario)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'apellidos' => 'sometimes|string|max:255',
            'dnie' => [
                'sometimes',
                'regex:/^([XYZ]?\d{7,8}[A-Z])$/',
                'unique:usuarios,dnie,' . $usuario->id,
            ],
            'email' => 'sometimes|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:6',
            'telefono' => ['sometimes', 'regex:/^[679]\d{8}$/'],
            'rol' => 'sometimes|in:admin,usuario',
            'carrito' => 'nullable|string',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $usuario->update($data);

        return response()->json($usuario);
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado']);
    }
}
