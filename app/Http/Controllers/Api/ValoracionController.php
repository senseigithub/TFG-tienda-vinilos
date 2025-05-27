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

    public function update(Request $request, $id)
{
    $valoracion = \App\Models\Valoracion::find($id);

    if (!$valoracion) {
        return response()->json(['error' => 'Valoración no encontrada'], 404);
    }

    $data = $request->validate([
        'comentario' => 'required|string',
    ]);

    $valoracion->comentario = $data['comentario'];
    $valoracion->save();

    // Opcional: recarga las relaciones para enviar info completa al frontend
    $valoracion->load(['usuario', 'vinilo']);

    return response()->json($valoracion);
}



    public function destroy($id)
    {
        $valoracion = \App\Models\Valoracion::find($id);

        if (!$valoracion) {
            return response()->json(['error' => 'Valoración no encontrada'], 404);
        }

        $valoracion->delete();

        return response()->json(['message' => 'Valoración eliminada']);
    }
}
