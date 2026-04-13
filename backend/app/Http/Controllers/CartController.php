<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Throwable;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function cleanCart(Request $request){
        try {
            $data = $request->validate([
            'user_id' => 'required|integer'
        ]);

        Cart::where('user_id' , $data['user_id'])->delete();

        return response()->json([
            'message' => 'Carrinho limpo com sucesso'
        ], 200);

        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function removeProduct(Request $request){
        try{
        $data = $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer'
        ]);

        Cart::where(['user_id' => $data['user_id']])
        ->where(['product_id' => $data['product_id']])->delete();

        return response()->json([
            'message' => 'Produto removido do carrinho'
        ], 200) ;
        }catch(Throwable $th){
            
        }
    }

    public function addProduct(Request $request){
        try{
        $data  = $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer'
        ]);

        Cart::create($data);

        return response()->json([
            'message' => 'Produto adicionado no carrinho'
        ], 200);
        }catch(Throwable $th){
            
        }

    }


}
