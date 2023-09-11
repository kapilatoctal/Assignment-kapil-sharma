<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResourceCollection;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $request->RouteIs('posts.index') || $request->RouteIs('users.index') ? Str::Limit($this->content,150) : $this->content,
            'category' => new CategoryResourceCollection($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'Published_date' => $this->created_at->format('d-M-Y'),
        ];
    }
}
