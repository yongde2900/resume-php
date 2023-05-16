<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(CommentResource::collection(Comment::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $comment = Comment::create($data);

        return response()->json(new CommentResource($comment));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return response()->json(new CommentResource($comment));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $data = $request->validated();
        $comment->update($data);

        return response()->json(new CommentResource($comment));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(null, 204);
    }
}
