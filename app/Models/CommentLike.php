<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $table = 'comments_likes'; // Assuming the table name is 'comments_likes'

    protected $fillable = [
        'comment_id',
        'user_id',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class); // Belongs to a comment
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Belongs to a user
    }
}
