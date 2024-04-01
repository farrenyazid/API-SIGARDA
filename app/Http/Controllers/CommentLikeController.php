<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    public function like(Request $request, $commentId)
    {
        // Validate user authentication
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Find the comment
        $comment = Comment::find($commentId);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found',
            ], 404);
        }

        // Check if user already liked the comment
        $existingLike = CommentLike::where('comment_id', $commentId)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingLike) {
            return response()->json([
                'success' => false,
                'message' => 'You already liked this comment',
            ], 422);
        }

        // Create a new like
        $like = new CommentLike;
        $like->comment_id = $commentId;
        $like->user_id = Auth::id();
        $like->save();

        // Update comment's like count
        $comment->increment('likes');

        return response()->json([
            'success' => true,
            'message' => 'Comment liked successfully',
            'data' => [
                'comment' => $comment->load('user'), // Eager load user data
            ],
        ], 200);
    }

    public function unlike(Request $request, $commentId)
    {
        // Validate user authentication
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Find the comment and existing like
        $comment = Comment::find($commentId);
        $like = CommentLike::where('comment_id', $commentId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found',
            ], 404);
        }

        if (!$like) {
            return response()->json([
                'success' => false,
                'message' => 'You haven\'t liked this comment yet',
            ], 404);
        }

        // Delete the like
        $like->delete();

        // Update comment's like count
        $comment->decrement('likes');

        return response()->json([
            'success' => true,
            'message' => 'Comment unliked successfully',
            'data' => [
                'comment' => $comment->load('user'), // Eager load user data
            ],
        ], 200);
    }
}
