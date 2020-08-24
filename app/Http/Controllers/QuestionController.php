<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->get();

        return response()->json($questions, 200);
    }

    public function show(Quiz $quiz,Question $question)
    {
        return response()->json($question, 200);
    }

    public function store(Request $request,Quiz $quiz)
    {

        $validator = Validator::make($request->all(), [

            'title' => 'required|string',
            'body' => 'required|string',
            
        ]);
         
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $question = $quiz->questions()->create($request->all());
            return response()->json(['message' => "Your question has been submitted successfully", 201]);
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
            return response()->json(['message' => "Your question has been updated", 200]);
        }
    }

    public function destroy(Quiz $quiz,Question $question)
    {
        $question->delete();
        return response()->json(['message' => "Your question has been removed", 204]);
    }

}
