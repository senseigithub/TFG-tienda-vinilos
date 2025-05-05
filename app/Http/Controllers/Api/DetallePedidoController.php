<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    public function index()
    {
        return DetallePedido::with(['pedido', 'vinilo'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'vinilo_id' => 'required|exists:vinilos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $detalle = DetallePedido::create($data);

        return response()->json($detalle, 201);
    }

    public function show(DetallePedido $detalles_pedido)
    {
        return $detalles_pedido->load(['pedido', 'vinilo']);
    }

    public function update(Request $request, DetallePedido $detalles_pedido)
    {
        $data = $request->validate([
            'pedido_id' => 'sometimes|exists:pedidos,id',
            'vinilo_id' => 'sometimes|exists:vinilos,id',
            'cantidad' => 'sometimes|integer|min:1',
            'precio_unitario' => 'sometimes|numeric|min:0',
        ]);

        $detalles_pedido->update($data);

        return response()->json($detalles_pedido);
    }

    public function destroy(DetallePedido $detalles_pedido)
    {
        $detalles_pedido->delete();

        return response()->json(['message' => 'Detalle de pedido eliminado']);
    }
}
