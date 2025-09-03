<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    protected $category;
    public function __construct(Request $request)
    {
        $this->category = $request->route('category') ? Category::find($request->route('category')) : null;

    }
    protected function category()
    {
        return $this->category;
    }
    /**
     * @OA\Get(
     *     path="/categories/{category}/posts",
     *     summary="Отримати список постів у категорії",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         description="ID категорії",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Номер сторінки",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
    *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
     *     )
     * )
     */
    public function index()
    {
        $posts = $this->category->posts()->latest()->paginate(1);
        return response()->json($posts);
    }

    /**
     * @OA\Post(
     *     path="posts",
     *     summary="Створити новий пост",
     *     description="Створює новий пост у категорії та повертає його у форматі JSON.",
     *     tags={"Posts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PostCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Пост створено успішно",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
     */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->validated());

        return response()->json($post, 201);
    }

    /**
     * @OA\Get(
     *     path="/posts/{id}",
     *     summary="Показати пост",
     *     description="Повертає один пост за ID у категорії.",
     *     tags={"Posts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успішно отримано пост",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пост не знайдено"
     *     )
     * )
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * @OA\Put(
     *     path="/posts/{id}",
     *     summary="Оновити пост",
     *     description="Оновлює існуючий пост за ID у категорії.",
     *     tags={"Posts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PostUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Пост оновлено успішно",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пост не знайдено"
     *     )
     * )
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        Gate::authorize('update', $post);
        $post->update($request->validated());

        return response()->json($post);
    }

    /**
     * @OA\Delete(
     *     path="/posts/{id}",
     *     summary="Видалити пост",
     *     description="Видаляє пост за ID у категорії.",
     *     tags={"Posts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Пост видалено успішно"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пост не знайдено"
     *     )
     * )
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();

        return response()->json(null, 204);
    }
}
