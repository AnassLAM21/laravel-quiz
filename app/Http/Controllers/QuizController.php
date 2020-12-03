<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Module;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Resources\QuizResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;
use stdClass;

class QuizController extends Controller 
{
    public function index()
    {
        
        $quizzes = Quiz::with(['author','module'])->latest()->paginate(10);        
        return  QuizResource::collection($quizzes);
    }

    public function show(Quiz $quiz)
    {
        return response()->json(['quiz' => new QuizResource($quiz)],200);
    }

    public function store(Module $module,Request $request)
    {

        
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $file = new File();
            
            $extension = $image->getClientOriginalExtension();
            $file->extension = $extension;
            $file->name = time().'.'.$extension;

            $file->type = 'Image';
            $path = $image->move('storage/images',$file->name);

            $pathName = pathinfo($path);
            $file->path = $pathName['dirname'].'/'.$pathName['basename'];
            $file->save();
        }

        

        
  
        $request = new Request([
            'title' => $request->title,
            'body' => $request->body,
            'publish' => (Boolean) $request->publish,
            'published_at' =>  $request->published_at,
            'time' =>  $request->time, //"time" :  "02:17:00", 
            'views_count'  => (int) $request->views_count,
            'votes_count'  => (int) $request->votes_count,
            'file'  => $request->file,
        ]);



   
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required|string',
            'publish' => 'required|boolean',
            'published_at' => 'nullable|date',
            'time' => 'nullable|date_format:H:i:s', //"time" :  "02:17:00", 
            'views_count' => 'nullable|Integer',
            'votes_count' => 'nullable|Integer',
            
        ]);
            
        
  
        //$FileController = new FileController();
        //$FileController->upload($request);

        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $quiz = $module->quizzes()->create($request->all() + ['user_id' => Auth::id()]);

            return response()->json(['message' => 'Your quiz has been submitted successfully', 
            'quiz' => new QuizResource($quiz)],201);

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
             $quiz->update($request->all() + ['user_id' => Auth::id()]);

            return response()->json(['message' => 'Your quiz has been updated successfully', 
            'quiz' => new QuizResource($quiz)],200);
        }
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return response()->json(['message' => "Your quiz has been removed", 204]);
    }

}