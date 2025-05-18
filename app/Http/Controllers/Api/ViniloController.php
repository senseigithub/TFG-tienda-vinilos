<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vinilo;
use Illuminate\Http\Request;

class ViniloController extends Controller
{
    public function index(Request $request)
    {
        $query = Vinilo::with('proveedor');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%$search%")
                    ->orWhere('artista', 'like', "%$search%");
            });
        }

        return $query->get();
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

    public function show($id)
    {
        return Vinilo::with('proveedor')->findOrFail($id);
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
