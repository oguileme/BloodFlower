<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return Categories::all();
        } catch (\Throwable $th) {
            
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
        try{
        $data = $request->validate([
            'name' => 'required|string'
        ]);
        
        Categories::created($data);
        return response()->json([
            'message'=>'Categoria cadastrada com sucesso'
        ], 201);
        }catch(\Throwable $th){

        }


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //mostrar todos a categoria e todos os produtos dela**********************************
        $categorie = Categories::with('products')->findOrFail($id);
        return response()->json($categorie,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $categories = Categories::firstOrFail($id);

        try {
            $data = $request->validate([
                'name' => 'sometimes|string'
            ]);

            $categories->update($data);

            return response()->json([
                'message'=>'categoria editada com sucesso',
                'data'=>$data
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $categories = Categories::findOrFail($id);
        $categories->delete();

        return response()->json([
            'message' => 'Categoria deleteda com sucesso'
        ], 200);
    }
}
