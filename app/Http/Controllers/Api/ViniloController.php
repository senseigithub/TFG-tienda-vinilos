<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vinilo;
use Illuminate\Http\Request;

class ViniloController extends Controller
{
    public function index()
    {
        return Vinilo::with('proveedor')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'titulo' => 'required|string|max:255',
            'artista' => 'required|string|max:255',
            'genero' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'required|string',
            'imagen' => 'required|string',
        ]);

        $vinilo = Vinilo::create($data);

        return response()->json($vinilo, 201);
    }

    public function show(Vinilo $vinilo)
    {
        return $vinilo->load('proveedor');
    }

    public function update(Request $request, Vinilo $vinilo)
    {
        $data = $request->validate([
            'proveedor_id' => 'sometimes|exists:proveedores,id',
            'titulo' => 'sometimes|string|max:255',
            'artista' => 'sometimes|string|max:255',
            'genero' => 'sometimes|string|max:100',
            'precio' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'descripcion' => 'sometimes|string',
            'imagen' => 'sometimes|string',
        ]);

        $vinilo->update($data);

        return response()->json($vinilo);
    }

    public function destroy(Vinilo $vinilo)
    {
        $vinilo->delete();

        return response()->json(['message' => 'Vinilo eliminado']);
    }
}
