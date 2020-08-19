<?php

namespace App\Http\Controllers;

use App\Module;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function index()
    {
        $quizs = Quiz::all();

        return response()->json($quizs, 200);
    }

    public function show(Module $module,Quiz $quiz)
    {
        // $Quiz = Quiz::find($id);

        return response()->json($quiz, 200);
    }

    public function store(Request $request,Module $module)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:quizzes|max:255',
            'body' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $quiz = $module->quizzes()->create($request->all() + ['user_id' => Auth::id()]);
            return response()->json(['message' => "Your quiz has been removed", 201]);
        }
    }

    public function update(Request $request,Module $module,Quiz $quiz)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:quizzes|max:255',
            'body' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $quiz = $quiz->update($request->all() + ['user_id' => Auth::id()]);
            return response()->json(['message' => "Your quiz has been removed", 200]);
        }
    }

    public function destroy(Module $module,Quiz $quiz)
    {
        $quiz->delete();
        return response()->json(['message' => "Your quiz has been removed", 204]);
    }

}
