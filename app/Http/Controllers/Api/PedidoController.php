<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return Pedido::with(['usuario', 'direccionEnvio'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'direccion_envio_id' => 'required|exists:direcciones_envio,id',
            'fecha_pedido' => 'required|date',
            'estado' => 'required|string|max:100',
            'total' => 'required|numeric|min:0',
        ]);

        $pedido = Pedido::create($data);

        return response()->json($pedido, 201);
    }

    public function show(Pedido $pedido)
    {
        return $pedido->load(['usuario', 'direccionEnvio']);
    }

    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->validate([
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'direccion_envio_id' => 'sometimes|exists:direcciones_envio,id',
            'fecha_pedido' => 'sometimes|date',
            'estado' => 'sometimes|string|max:100',
            'total' => 'sometimes|numeric|min:0',
        ]);

        $pedido->update($data);

        return response()->json($pedido);
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return response()->json(['message' => 'Pedido eliminado']);
    }
}
