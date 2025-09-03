<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Отримати список категорій",
     *     description="Повертає всі категорії у форматі JSON.",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="Успішно отримано список категорій",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Category"))
     *     )
     * )
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     summary="Створити нову категорію",
     *     description="Створює нову категорію та повертає її у форматі JSON.",
     *     tags={"Categories"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CategoryCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Категорію створено успішно",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     )
     * )
     */
    public function store(CategoryCreateRequest $request)
    {

        $category = Category::create($request->validated());
        return response()->json($category, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     summary="Показати категорію",
     *     description="Повертає одну категорію за ID.",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID категорії",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успішно отримано категорію",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Категорію не знайдено"
     *     )
     * )
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     summary="Оновити категорію",
     *     description="Оновлює існуючу категорію за ID.",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID категорії",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CategoryUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Категорію оновлено успішно",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Категорію не знайдено"
     *     )
     * )
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json($category);
    }

    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     summary="Видалити категорію",
     *     description="Видаляє категорію за ID.",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID категорії",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Категорію видалено успішно"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Категорію не знайдено"
     *     )
     * )
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
