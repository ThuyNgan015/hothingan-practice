<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
/**
 * @OA\Post(
 *     path="/api/posts",
 *     summary="Create a new post",
 *     description="Create a new post with the provided title and description",
 *     tags={"Post"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description"},
 *             @OA\Property(property="title", type="string", example="New Post Title"),
 *             @OA\Property(property="description", type="string", example="This is a new post description")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json"
 *         )
 *     )
 * )
 * 
 * @OA\Get(
 *     path="/api/posts/{id}",
 *     summary="Get post by ID",
 *     description="Get a post by its ID",
 *     tags={"Post"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the post to retrieve",
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
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="description", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Post not found"
 *     )
 * )
 * 
 * @OA\Put(
 *     path="/api/posts/{id}",
 *     summary="Update post",
 *     description="Update an existing post",
 *     tags={"Post"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the post to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description"},
 *             @OA\Property(property="title", type="string", example="Updated Post Title"),
 *             @OA\Property(property="description", type="string", example="This is an updated post description")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Post updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Post not found"
 *     )
 * )
 * 
 * @OA\Delete(
 *     path="/api/posts/{id}",
 *     summary="Delete post",
 *     description="Delete an existing post",
 *     tags={"Post"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the post to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Post deleted successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Post not found"
 *     )
 * )
 */
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}