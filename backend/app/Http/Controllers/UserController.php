<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return User::all();
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
        try{
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::create($data);
        return response()->json([
            'massege' => 'usuario criado com sucesso',
            'data' => $user
        ], 201);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }


    
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $user = User::firstOrFail($id);



            return response()->json(['data' => $user], 200);
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'usuario deletado com sucesso']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
