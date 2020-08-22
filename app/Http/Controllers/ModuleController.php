<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();

        return response()->json($modules, 200);
    }

    public function show(Module $module)
    {
        // $module = Module::find($id);

        return response()->json($module, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:modules|max:255',
            'body' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $module = Module::create($request->all() + ['user_id' => Auth::id()]);
            return response()->json(['message' => 'Your module has been submitted successfully', 201]);
        }
    }

    public function update(Request $request, Module $module)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:modules|max:255',
            'body' => 'required',
        ]);
         
        if ($validator->fails()) {
            return response()->json($validator->errors()->get('*'),500);
        }else{
            $module = $module->update($request->all() + ['user_id' => Auth::id()]);
            return response()->json(['message' => 'Your module has been updated', 200]);
        }
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return response()->json(['message' => "Your module has been removed", 204]);
    }

}
