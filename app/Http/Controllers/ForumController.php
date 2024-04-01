<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumLog;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function handleUpdate(Request $request, Forum $forum)
    {
        // Update the forum entry with validated data
        $forum->update($request->validated());  // Update the forum entry

        // Get the original data before update (optional)
        $originalTitle = $forum->getOriginal('title');
        $originalDescription = $forum->getOriginal('description');

        // Create a new forum log entry
        $forumLog = new ForumLog;
        $forumLog->forum_id = $forum->id;
        $forumLog->action = 'edited'; //Set the action
        
        // Validate optional data for changes (if applicable)
        if (isset($originalTitle) && $originalTitle !== $forum->title) {
            $forumLog->previous_title = $originalTitle;
            $forumLog->new_title = $forum->title;
        }
        if (isset($originalDescription) && $originalDescription !== $forum->description) {
            $forumLog->previous_description = $originalDescription;
            $forumLog->new_description = $forum->description;
        }

        $forumLog->save();   // Save the log entry

        // ... rest of your logic (e.g., redirect, flash messages)
    }
}


