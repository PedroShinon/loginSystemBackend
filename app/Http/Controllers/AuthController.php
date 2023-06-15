<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use App\Http\Requests\UserFormRegister;
use App\Http\Requests\UserFormLogin;
use App\Http\Requests\LogoutForm;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(UserFormLogin $request)
    {
        $validatedData = $request->validated();
        
        $user = User::where('email', $validatedData['email'])->firstOrFail();

        if (Hash::check($validatedData['password'], $user->password)) {
            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);

            
        }
        
        return response()->json(['error' => 'alguma coisa deu errado']);
        
    }

    public function register(UserFormRegister $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $token = $user->createToken('user_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(LogoutForm $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->tokens()->delete();

        return response()->json('Usuário deslogado', 200);
    }

    public function verifyAuth(Request $request)
    {

        if($user = $request->user()){
            return response()->json(['valor' => true], 200);
        }

        return response()->json(['valor' => false], 401);
        
    }
}
