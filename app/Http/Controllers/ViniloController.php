<?php

namespace App\Http\Controllers;

use App\Models\Vinilo;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ViniloController extends Controller
{
    public function index()
    {
        $vinilos = Vinilo::with('proveedor')->get();
        return view('vinilos.index', compact('vinilos'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('vinilos.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'artista' => 'required|string',
            'genero' => 'required|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);

        Vinilo::create($request->all());

        return redirect()->route('vinilos.index')->with('success', 'Vinilo creado');
    }

    public function show(Vinilo $vinilo)
    {
        return view('vinilos.show', compact('vinilo'));
    }

    public function edit(Vinilo $vinilo)
    {
        $proveedores = Proveedor::all();
        return view('vinilos.edit', compact('vinilo', 'proveedores'));
    }

    public function update(Request $request, Vinilo $vinilo)
    {
        $vinilo->update($request->all());
        return redirect()->route('vinilos.index')->with('success', 'Vinilo actualizado');
    }

    public function destroy(Vinilo $vinilo)
    {
        $vinilo->delete();
        return redirect()->route('vinilos.index')->with('success', 'Vinilo eliminado');
    }
}
