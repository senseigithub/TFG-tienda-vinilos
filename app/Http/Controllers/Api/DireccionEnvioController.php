<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DireccionEnvio;
use Illuminate\Http\Request;

class DireccionEnvioController extends Controller
{
    public function index()
    {
    return DireccionEnvio::where('usuario_id', auth()->user()->id)->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
        ]);

        $direccion = DireccionEnvio::create($data);

        return response()->json($direccion, 201);
    }

    public function show(DireccionEnvio $direcciones_envio)
    {
        return $direcciones_envio->load('usuario');
    }

    public function update(Request $request, DireccionEnvio $direcciones_envio)
    {
        $data = $request->validate([
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'direccion' => 'sometimes|string|max:255',
            'ciudad' => 'sometimes|string|max:100',
            'codigo_postal' => 'sometimes|string|max:20',
            'telefono' => 'sometimes|string|max:20',
        ]);

        $direcciones_envio->update($data);

        return response()->json($direcciones_envio);
    }

    public function destroy(DireccionEnvio $direcciones_envio)
    {
        $direcciones_envio->delete();

        return response()->json(['message' => 'Dirección de envío eliminada']);
    }
}
