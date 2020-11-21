<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\QuestionResource;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index()
    {

        $questions =  Question::with('choices')->get();
        return QuestionResource::collection($questions);
    }

    public function show(Question $question)
    {
        // return response()->json([
        //     'id' => $this->id,
        //     'title' => $this->title,
        //     'body' => $this->body,
        //     'user_id' => $this->user_id,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at], 200);

        return response()->json(['question'=> new QuestionResource($question)], 200);
    }


    public function store(Request $request,Quiz $quiz)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string',
        ]);
         
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $question = $quiz->questions()->create($request->all());
            return response()->json(['message' => 'Your question has been submitted successfully',
            'question' => new QuestionResource($question, 201)]);
        }
    }

    public function update(Request $request,Quiz $quiz,Question $question)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'required|string',
            'body' => 'required|string',
            
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $question->update($request->all());
            return response()->json(['message' => 'Your question has been updated',
            'question' => new QuestionResource($question, 201)]);
        }
    }

    public function destroy(Quiz $quiz,Question $question)
    {
        $question->delete();
        return response()->json(['message' => "Your question has been removed", 204]);
    }

}
