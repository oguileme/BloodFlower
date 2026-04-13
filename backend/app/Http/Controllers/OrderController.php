<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        try {
            return response()->json(Order::all());
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    

    //cirando um novo pedido
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'user_id'            => 'required|integer',
                'payment_status'     => 'required|string',
                'order_status'       => 'required|string',
                'outstanding_portion'=> 'sometimes|integer',
                'installment_paid'   => 'sometimes|integer',
                'total'              => 'required|numeric'
            ]);

            $order = Order::create($data);

            return response()->json([
                'message' => 'Pedido realizado com sucesso.',
                'data'    => $order
            ], 201);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    

    //mostrando os protudos de uma order
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            return $order->load('products'); // pegando os produtos do pedido 
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    //atualizando status de um produto
    public function updateStatus($id, Request $request)
    {
        try {
            $order = Order::findOrFail($id);

            $data = $request->validate([
                'order_status' => 'required|string'
            ]);

            $order->update($data);

            return response()->json(['message' => 'Status do pedido alterado com sucesso.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    //atualizando como as parcelas paga && atuliza o status de pagamento caso ja fique pronta
    public function updateInstallmentPlan($id)
    {
        try {
            $order = Order::findOrFail($id);

            if ($order->payment_status !== 'parcelado' || $order->installment_paid >= $order->outstanding_portion) {
                return response()->json(['message' => 'Pagamento de parcela não permitido.'], 422);
            }

            $newInstallmentPaid = $order->installment_paid + 1;
            $paymentStatus = $newInstallmentPaid >= $order->outstanding_portion ? 'pago' : 'parcelado';

            $order->update([
                'installment_paid' => $newInstallmentPaid,
                'payment_status'   => $paymentStatus,
            ]);

            return response()->json(['message' => 'Pagamento de parcela realizado com sucesso.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}