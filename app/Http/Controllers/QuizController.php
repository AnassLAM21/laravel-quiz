<?php

namespace App\Http\Controllers;
;
use App\Models\Quiz;
use App\Models\Module;
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

            'publish' => 'required|boolean',
            'published_at' => 'nullable|date',
            'time' => 'nullable|date_format:H:i:s', //"time" :  "02:17:00", 
            'views_count' => 'Integer',
            'votes_count' => 'Integer',
            
        ]);
         
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $quiz = $module->quizzes()->create($request->all() + ['user_id' => Auth::id()]);
            return response()->json(['message' => "Your quiz has been submitted successfully", 201]);
        }
    }

    public function update(Request $request,Module $module,Quiz $quiz)
    {
        $validator = Validator::make($request->all(), [

            'publish' => 'required|boolean',
            'published_at' => 'nullable|date',
            'time' => 'nullable|date_format:H:i:s', //"time" : "02:17:00" ,
            'views_count' => 'Integer',
            'votes_count' => 'Integer',
            
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $quiz = $quiz->update($request->all() + ['user_id' => Auth::id()]);
            return response()->json(['message' => "Your quiz has been updated", 200]);
        }
    }

    public function destroy(Module $module,Quiz $quiz)
    {
        $quiz->delete();
        return response()->json(['message' => "Your quiz has been removed", 204]);
    }

}
