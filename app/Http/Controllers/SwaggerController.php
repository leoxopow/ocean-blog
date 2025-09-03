<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Ocean Blog API",
 *     description="Blogs API documentation"
 * )
 *
 * @OA\Server(
 *     url="http://localhost/api",
 *     description="Dev version"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", example="john@example.com"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 * @OA\Schema(
 *  schema="Category",
 *  type="object",
 *  @OA\Property(property="id", type="integer", example=1),
 *  @OA\Property(property="name", type="string", example="News"),
 *  @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-03T12:00:00Z"),
 *  @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-03T12:00:00Z")
 * )
 * @OA\Schema(
 *  schema="Post",
 *  type="object",
 *  @OA\Property(property="id", type="integer", example=1),
 *  @OA\Property(property="title", type="string", example="My First Post"),
 *  @OA\Property(property="content", type="string", example="This is the content of the post."),
 *  @OA\Property(property="category_id", type="integer", example=1),
 *  @OA\Property(property="user_id", type="integer", example=1),
 *  @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-03T12:00:00Z"),
 *  @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-03T12:00:00Z")
 * )
 * @OA\Schema(
 *  schema="Comment",
 *  type="object",
 *  @OA\Property(property="id", type="integer", example=1),
 *  @OA\Property(property="content", type="string", example="This is a comment."),
 *  @OA\Property(property="post_id", type="integer", example=1),
 *  @OA\Property(property="user_id", type="integer", example=1),
 *  @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-03T12:00:00Z"),
 *  @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-03T12:00:00Z")
 * )
 * @OA\Schema(
 *  schema="CategoryCreateRequest",
 *  type="object",
 *  @OA\Property(property="name", type="string", example="News"),
 *  @OA\Property(property="description", type="string", example="Latest news and updates"),
 *  @OA\Property(property="slug", type="string", example="news")
 * )
 * @OA\Schema(
 *  schema="CategoryUpdateRequest",
 *  type="object",
 *  @OA\Property(property="name", type="string", example="News"),
 *  @OA\Property(property="description", type="string", example="Latest news and updates"),
 *  @OA\Property(property="slug", type="string", example="news")
 * )
 * @OA\Schema(
 *  schema="PostCreateRequest",
 *  type="object",
 *  @OA\Property(property="title", type="string", example="My First Post"),
 *  @OA\Property(property="content", type="string", example="This is the content of the post."),
 *  @OA\Property(property="category_id", type="integer", example=1)
 * )
 * @OA\Schema(
 *  schema="PostUpdateRequest",
 *  type="object",
 *  @OA\Property(property="title", type="string", example="Updated Title"),
 *  @OA\Property(property="content", type="string", example="Updated content.")
 * )
 * @OA\Schema(
 *  schema="CommentCreateRequest",
 *  type="object",
 *  @OA\Property(property="content", type="string", example="This is a comment."),
 *  @OA\Property(property="post_id", type="integer", example=1)
 * )
 * @OA\Schema(
 *  schema="CommentUpdateRequest",
 *  type="object",
 *  @OA\Property(property="content", type="string", example="This is an updated comment.")
 * )
 */
class SwaggerController {}
