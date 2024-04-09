<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
/**
 * @OA\Post(
 *     path="/api/users",
 *     summary="Create a new users",
 *     description="Create a new users with the provided name, email and password",
 *     tags={"User"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="New User Name"),
 *             @OA\Property(property="email", type="string", example="user.1@gmail.com"),
 *             @OA\Property(property="password", type="string", example="user123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User created successfully",
 *         @OA\MediaType(
 *             mediaType="application/json"
 *         )
 *     )
 * )
 * 
 * @OA\Get(
 *     path="/api/users/{id}",
 *     summary="Get user by ID",
 *     description="Get a user by its ID",
 *     tags={"User"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the user to retrieve",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer"),
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 * 
 * @OA\Put(
 *     path="/api/users/{id}",
 *     summary="Update user",
 *     description="Update an existing user",
 *     tags={"User"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the user to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="Updated User Name"),
 *             @OA\Property(property="email", type="string", example="updated.user@gmail.com"),
 *             @OA\Property(property="password", type="string", example="updated123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 * 
 * @OA\Delete(
 *     path="/api/users/{id}",
 *     summary="Delete user",
 *     description="Delete an existing user",
 *     tags={"User"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the user to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = Users::create($request->all());
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = Users::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        Users::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
