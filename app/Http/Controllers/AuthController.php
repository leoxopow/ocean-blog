<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/login",
     *     summary="Login user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="secret")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Token"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('API Token')->plainTextToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request) {
        // Логіка виходу
    }
}
