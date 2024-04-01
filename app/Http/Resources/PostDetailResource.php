<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author' => $this->author,
            'title' => $this->title,
            'image' => $this->image,
            'news_content' => $this->news_content,
            'created_at' => date_format($this->created_at, 'd-m-Y H:i'),
            'writer' => $this->whenLoaded('writer'), //eager loading
            'comments' => $this->whenLoaded('comments', function () {
                return  collect($this->comments)->each(function ($comment){
                    return $comment->commentator;
                });
            }),
            'comments_count' => $this->whenLoaded('comments', function () {
                return $this->comments->count();
            }),
        ];
    }
}
