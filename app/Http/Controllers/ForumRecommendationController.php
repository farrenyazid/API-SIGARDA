<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumRecommendation;

class ForumRecommendationController extends Controller
{
    public function getRecommendations()
    {
        // Retrieve recommended forum IDs using your preferred logic
        $recommendedForumIds = $this->getRecommendedForumIds(); // Replace with your logic

        // Efficiently fetch recommended forums with title and description
        $forums = Forum::whereIn('id', $recommendedForumIds)
            ->select('id', 'title', 'description')
            ->get();

        return response()->json($forums);
    }

    // Replace this with your recommendation logic
    private function getRecommendedForumIds()
    {
        return ForumRecommendation::pluck('forum_id')->toArray(); // Example using forum_recommendations table
    }
}
