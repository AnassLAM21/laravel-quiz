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
            'publish' => $this->when($this->publish, true,false),
            'published_at' => $this->published_at,
            'time' => $this->time,
            'views_count' => $this->views_count,
            'votes_count' => $this->votes_count,
            'user_id' => $this->user_id,
            'module' => new ModuleResource($this->Module),
            'author' => new UserResource($this->author),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];

        
    }


   
    
}
