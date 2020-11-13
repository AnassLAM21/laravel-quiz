<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            'body' => $this->body,
            'publish' => $this->publish,
            'published_at' => $this->published_at,
            'time' => $this->time,
            'views_count' => $this->views_count,
            'votes_count' => $this->votes_count,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'module' => new ModuleResource($this->Module),
            'user' => new UserResource($this->author),
        ];
    }
}
