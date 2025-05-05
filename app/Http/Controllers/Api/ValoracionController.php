<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Valoracion;
use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    public function index()
    {
        return Valoracion::with(['usuario', 'vinilo'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'vinilo_id' => 'required|exists:vinilos,id',
            'comentario' => 'required|string',
            'fecha_valoracion' => 'required|date',
        ]);

        $valoracion = Valoracion::create($data);

        return response()->json($valoracion, 201);
    }

    public function show(Valoracion $valoracion)
    {
        return $valoracion->load(['usuario', 'vinilo']);
    }

    public function update(Request $request, Valoracion $valoracion)
    {
        $data = $request->validate([
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'vinilo_id' => 'sometimes|exists:vinilos,id',
            'comentario' => 'sometimes|string',
            'fecha_valoracion' => 'sometimes|date',
        ]);

        $valoracion->update($data);

        return response()->json($valoracion);
    }

    public function destroy(Valoracion $valoracion)
    {
        $valoracion->delete();

        return response()->json(['message' => 'Valoración eliminada']);
    }
}
