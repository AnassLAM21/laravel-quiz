<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function upload(Request $request)
    {
        //name	extension	path	type	
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
          ]);
          if ($request->hasFile('file')) {
            $image = $request->file('file');

            $file = new File();

            // $file->name = time().'.'.$image->getClientOriginalExtension();
            // $file->extension = $image->getClientOriginalExtension();
            // $path = public_path('storage/images');
            // $file->type = $request->type;
            // $file->path = $image->move($path,$file->name);

            $file->name = $image->getClientOriginalName();
            $path = $image->move('storage/images',time().'_'.$image->getClientOriginalName());
            $$file->type = $image->getClientOriginalExtension();
            $PATHName = pathinfo($path);
            $file->path  = $PATHName['dirname'].'/'.$PATHName['basename'];
            
            $file->save();

            return response()->json(["message" => "resut"]);
          }
    }
}
