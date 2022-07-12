<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request)
  {

    $folder = date('Y-m-d');
    $path = $request->file('thumbnail')->store("images/{$folder}");

    $image = new Image;
    $image->thumbnail = $path;
    $image->save();

    return response()->json([
      'message' => 'Image added successfully',
      'image' => $image
    ], 201);
  }



  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy($id)
  {
    $image = Image::find($id);

    Storage::delete($image->thumbnail);

    $image->delete();

    return response()->json([
      'message' => 'Image deleted successfully',
    ], 201);
  }
}
