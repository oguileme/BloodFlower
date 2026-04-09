<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Product::all();
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
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string'
        ]);

        $product = Product::create($data);

        return response()->json([
            'message' => 'Produto criado com sucesso',
            'data' => $product
        ], 201);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::firstOrFail($id);

            return response()->json(['data' => $product], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string',
            'price' => 'sometimes|string',
            'description' => 'sometimes|string'
            ]);

        $product->update($data);

        return response()->json([
            'message' => 'Produto cadastrado com sucesso',
            'data' => $product
        ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 500);

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json(['message' => 'Produto deletado com sucesso']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
}
