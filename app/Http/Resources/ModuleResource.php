<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
                'quizzes' => QuizResource::collection($this->quizzes),
                'user' => new UserResource($this->user),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
    }
}
