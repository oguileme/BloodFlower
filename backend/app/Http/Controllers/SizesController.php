<?php

namespace App\Http\Controllers;

use App\Models\Sizes;
use Illuminate\Http\Request;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            return Sizes::all();
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
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
            $data = $request->validate(['data' => 'required|string']);
            $size = Sizes::create($data);

            return response()->json([
                'message' => 'Tamanho cadastrado com sucesso',
                'data' => $size
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $size = Sizes::with('products')->findOrFail($id);
            
            return response()->json($size);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sizes $sizes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->validate(['name' => 'required|string']);
        Sizes::findOrFail($id)->update($data);
        return response()->json(['message' => 'Tamanho editado com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            Sizes::findOrFail($id)->delete();

            return response()->json(['message' => 'Tamanho deletado com sucesso'], 200);
        } catch (\Throwable $th) {
            //throw $th;

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
