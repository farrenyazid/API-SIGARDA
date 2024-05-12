<?php

namespace App\Http\Controllers;

use App\Models\Following;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(Request $request, User $user)
    {
        // Check if user is trying to follow themselves
        if ($user->id === Auth::user()->id) {
            return response()->json(['message' => 'Cannot follow yourself'], 422);
        }

        // Check if already following
        if (Following::where('follower_id', Auth::user()->id)
            ->where('followed_id', $user->id)
            ->exists()) {
            return response()->json(['message' => 'Already following this user'], 422);
        }

        // Create a new following record
        $follow = Following::create([
            'follower_id' => Auth::user()->id,
            'followed_id' => $user->id,
        ]);

        return response()->json($follow, 201); // Created status code
    }
}

