<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Correct import
use Illuminate\Support\Facades\Gate;

class UpvoteController extends Controller
{
    public function upvote(Request $request, $post_id)
    {
        // Validate parameter
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Find the post
        $post = Post::find($post_id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found',
            ], 404);
        }

        // Authorization using Gate
        if (!Gate::allows('upvote', $post)) {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden',
            ], 403);
        }

        // Increment upvotes and save the post
        $post->increment('upvotes');
        $post->save();

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Post upvoted successfully',
            'data' => [
                'post' => $post,
            ],
        ], 200);
    }
}
