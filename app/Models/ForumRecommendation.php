<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_id',
    ];

    /**
     * The forum associated with the recommendation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
