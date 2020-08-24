<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChoiceController extends Controller
{
    public function index(Question $question)
    {
        $choices = $question->choices()->get();

        return response()->json($choices, 200);
    }

    public function show(Question $question,Choice $choice)
    {
        return response()->json($choice, 200);
    }

    public function store(Request $request,Question $question)
    {

        $validator = Validator::make($request->all(), [

            'body' => 'required|string',
            'is_right_choice' => 'required|boolean',
            
        ]);
         
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $choice = $question->choices()->create($request->all());
            return response()->json(['message' => "Your choice has been submitted successfully", 201]);
        }
    }

    public function update(Request $request,Question $question,Choice $choice)
    {
        $validator = Validator::make($request->all(), [

            'body' => 'required|string',
            'is_right_choice' => 'required|boolean',
            
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $choice->update($request->all());
            return response()->json(['message' => "Your choice has been updated", 200]);
        }
    }

    public function destroy(Question $question,Choice $choice)
    {
        $choice->delete();
        return response()->json(['message' => "Your choice has been removed", 204]);
    }
}
