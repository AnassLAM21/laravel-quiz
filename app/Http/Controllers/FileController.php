<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{


    function __construct() {
  
    }

    public function upload(Request $request)
    {
        //name	extension	path	type	
        $this->validate($request, [
            'file' => 'required',
          ]);


          
          if ($request->hasFile('file')) {

            $image = $request->file('file');
            $fileName = time().'_'.$image->getClientOriginalName();;
            $file = new File();

            // $file->name = time().'.'.$image->getClientOriginalExtension();
            // $file->extension = $image->getClientOriginalExtension();
            // $path = public_path('storage/images');
            // $file->type = $request->type;
            // $file->path = $image->move($path,$file->name);

            $fileName = time().'_'.$image->getClientOriginalName();
            $filePath = $image->storeAs('images', $fileName, 'public');
            $file->extension = $image->getClientOriginalExtension();
            $file->name = time().'_'.$request->file->getClientOriginalName();
            $file->path = '/storage/' . $filePath;
            $file->type = $request->type;

            $file->save();
            
            return response()->json(["message" => "The fil has been syccessfully uploaded "]);

          }
    }
}
