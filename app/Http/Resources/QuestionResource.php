<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'choices_count' => $this->choices_count,
            'right_choice_id' => $this->right_choice_id,
            'quiz_id' => $this->quiz_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'choices' => ChoiceResource::collection($this->choices),
        ];
    }
}
