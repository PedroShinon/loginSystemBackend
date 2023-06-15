<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'user' => $user
        ], 200);
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
    public function update(UserFormUpdate $request)
    {
        $validatedData = $request->validated();

        $user = $request->user();
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        if($validatedData['password']){
            $user->password = Hash::make($validatedData['password']);
        }
        
        $user->save();

        return response()->json([
            'message' => 'usuario atualizado'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {

            $user = $request->user();
            if ($user->email == $request->email) {

               $user->tokens()->delete();
                $user->delete();
                return response()->json('Conta foi deletada', 200);

            } else {

                return response()->json('Email não corresponde', 201);
            }
            

            return response()->json('Usuário apagado', 200);

        } catch (\Throwable $th) {

            return response()->json('Erro inesperado', 400);
        }
        
    }
}
