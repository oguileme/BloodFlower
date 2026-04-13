<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            return Order::all();
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'error' => $th,
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $data = $request->validate([
                'user_id' => 'required|integer',
                'payment_status' => 'required|string',
                'order_status' => 'required|string',
                'outstranding_portion' => 'sometimes|integer', // parcelas pendentes
                'installment_paid' => 'sometimes|integer', // parcelas pagas
                'total' => 'required|double',
            ]);

            Order::create($data);

            return response()->json([
                'message' => 'pedido realizado com sucesso',
                'data' => $data,
            ], 201);

        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'error' => $th,
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $order = Order::firstOrFail($id)->find();

        return response()->json([
            'data' => $order,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function UpdateStatusOrder($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $data = $request->validate([
            'order_status' => 'required|string',
        ]);

        $order->update($data);
    }

    public function UpdateInstallmentPlan($id)
    {
        try {
            $order = Order::findOrFail($id);

            if ($order->payment_status !== 'parcelado' || $order->installment_paid >= $order->outstanding_portion) {
                return response()->json([
                    'message' => 'Pagamento de parcela não permitido.',
                ], 422);
            }

            $newInstallmentPaid = $order->installment_paid + 1;

            $paymentStatus = $newInstallmentPaid >= $order->outstanding_portion
                ? 'pago'
                : 'parcelado';

            $order->update([
                'installment_paid' => $newInstallmentPaid,
                'payment_status' => $paymentStatus,
            ]);

            return response()->json([
                'message' => 'Pagamento de parcela realizado com sucesso.',
            ]);
        } catch (\Throwable $th) {

        }
    }

    public function UpdateStatus($id, Request $request)
    {
        $order = Order::fildOrFail($id);
        $data = $request->validate([
            'order_status' => 'required|string',
        ]);

        $order->update($data);

        return response()->json([
            'messagem' => 'Status do pedido alterado com sucesso',
        ], 200);

    }
}
