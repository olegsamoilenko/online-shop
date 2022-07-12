<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
  /**
   * Display a listing of the tags.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
   */
  public function index()
  {
    $tags = Tag::all();

    return view('admin.pages.tags', [
      'tags' => $tags
    ]);
  }

  /**
   * Get categories in the header.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function get()
  {
    $tags = Tag::all();

    return response()->json([
      'tags' => $tags
    ], 201);
  }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTagRequest $request)
    {
      $data = $request->validated();


      $tag = Tag::create(
        $data
      );


      return response()->json([
        'message' => 'Tag successfully created',
        'tag' => $tag
      ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Tag $tag)
    {
      return response()->json([
        'tag' => $tag
      ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
      $tag->slug = null;
      $tag->update($request->all());


      return response()->json([
        'message' => 'Tag  successfully updated',
        'tag' => $tag
      ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tag $tag)
    {
      $tag->delete();

      return response()->json([
        'message' => 'Tag  successfully deleted',
      ], 201);
    }
}
