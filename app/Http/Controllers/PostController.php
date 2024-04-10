<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
/**
 * @OA\Get(
 *    path="/api/posts",
 *    summary="Get all posts",
 *    description="Get all posts without specifying an ID",
 *    tags={"Post"},
 *    @OA\Response(
 *        response=200,
 *        description="OK",
 *        @OA\JsonContent(
 *            type="array",
 *            @OA\Items(
 *                type="object",
 *                @OA\Property(property="id", type="integer"),
 *                @OA\Property(property="title", type="string"),
 *                @OA\Property(property="description", type="string")
 *            )
 *        )
 *    )
 *)
 *
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
        return Post::all();
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        $post = new User();
        $post->user_id = $request->input('user_id');
        $post->user_id = $post->id;
        $post->save();
        return $post;
    }

    public function show($id)
    {
        return Post::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return $post;
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return 204;
    }
}