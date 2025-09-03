<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentUpdateRequest;


class CommentsController extends Controller
{

    protected $post;

    public function __construct(Request $request)
    {
        $this->post = $request->route('post') ? Post::find($request->route('post')) : null;
    }

    /**
     * @OA\Get(
     *     path="/posts/{post}/comments",
     *     summary="Get list of comments",
     *     description="Returns paginated list of comments for a post.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="Post ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved list of comments",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Comment"))
     *     )
     * )
     */
    public function index()
    {
        $comments = $this->post->comments()->latest()->paginate(10);
        return response()->json($comments);
    }

    /**
     * @OA\Get(
     *     path="/posts/{post}/comments/{id}",
     *     summary="Show comment",
     *     description="Returns a single comment by ID for a post.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="Post ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Comment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved comment",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     )
     * )
     */
    public function show(Comment $comment)
    {
        return response()->json($comment);
    }

    /**
     * @OA\Post(
     *     path="/comments",
     *     summary="Create a new comment",
     *     description="Creates a new comment for a post and returns it as JSON.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="Post ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CommentCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Comment created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     )
     * )
     */
    public function store(CommentCreateRequest $request)
    {
        $comment = Comment::create($request->validated());

        return response()->json($comment, 201);
    }

    /**
     * @OA\Put(
     *     path="/comments/{id}",
     *     summary="Update comment",
     *     description="Updates an existing comment by ID for a post.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="Post ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Comment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CommentUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comment updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     )
     * )
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        Gate::authorize('update', $comment);
        $comment->update($request->validated());

        return response()->json($comment);
    }

    /**
     * @OA\Delete(
     *     path="/comments/{id}",
     *     summary="Delete comment",
     *     description="Deletes a comment by ID for a post.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="Post ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Comment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Comment deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     )
     * )
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        $comment->delete();

        return response()->json(null, 204);
    }
}
