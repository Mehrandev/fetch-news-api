<?php

namespace App\Http\Resources\V1\Article;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at->toDateTimeString(),

            // Include category and source details
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'source' => [
                'id' => $this->source->id,
                'name' => $this->source->name,
            ],
        ];
    }
}
