<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class FileController extends Controller
{
  public function uploadFile(Request $request) {
      $file = Input::file('file');
      $filename = $file->getClientOriginalName();

      $path = hash( 'sha256', time());

      if(Storage::disk('uploads')->put($path.'/'.$filename,  File::get($file))) {
          $input['name'] = $filename;
          $input['type'] = $file->getClientMimeType();
          $input['path'] = $path;
          $input['size'] = $file->getClientSize();
          $file = File::create($input);

          return response()->json([
              'success' => true,
              'id' => $file->id
          ], 200);
      }
      return response()->json([
          'success' => false
      ], 500);
  }
}
