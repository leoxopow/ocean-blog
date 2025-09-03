<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Get all users",
     *     description="Returns all users in JSON format.",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved list of users",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     )
     * )
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
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
}
