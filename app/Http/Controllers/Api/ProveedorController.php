<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        return response()->json(Proveedor::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:proveedores,email',
            'telefono' => ['required', 'regex:/^[679]\d{8}$/'],
            'direccion' => 'required|string|max:255',
        ]);

        $proveedor = Proveedor::create($data);

        return response()->json($proveedor, 201);
    }

    public function show(Proveedor $proveedor)
    {
        return response()->json($proveedor, 200);
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['error' => 'Proveedor no encontrado'], 404);
        }

        $data = $request->validate([
            'nombre'    => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'telefono'  => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:500',
        ]);

        $proveedor->update($data);

        return response()->json($proveedor, 200);
    }

    public function destroy($id)
    {
        $proveedor = \App\Models\Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['error' => 'Proveedor no encontrado'], 404);
        }
        $proveedor->delete();

        return response()->json(['message' => 'Proveedor eliminado correctamente.'], 200);
    }
}
