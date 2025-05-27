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

    public function update(Request $request, Proveedor $proveedor)
{
    $data = $request->validate([
        'nombre' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|unique:proveedores,email,' . $proveedor->id,
        'telefono' => ['sometimes', 'regex:/^[679]\d{8}$/'],
        'direccion' => 'sometimes|string|max:255',
    ]);

    $proveedor->update($data);

    return response()->json($proveedor, 200);
}


    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return response()->json(['message' => 'Proveedor eliminado correctamente.'], 200);
    }
}
