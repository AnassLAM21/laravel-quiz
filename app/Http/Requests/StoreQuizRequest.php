<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'publish' => 'required|boolean',
            'published_at' => 'nullable|date',
            'time' => 'nullable|date_format:H:i:s', //"time" :  "02:17:00", 
            'views_count' => 'Integer',
            'votes_count' => 'Integer',
        ];
    }
}
