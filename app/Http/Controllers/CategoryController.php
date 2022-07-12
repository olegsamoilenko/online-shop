<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::all()->load('products');

      return view('admin.pages.categories', [
        'categories' => $categories
      ]);
    }

  /**
   * Get categories in the header.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function get()
  {
    $categories = Category::all();

    return response()->json([
      'categories' => $categories
    ], 201);
  }


  /**
   * Store a newly created category in storage.
   *
   * @param StoreCategoryRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(StoreCategoryRequest $request)
  {
    $data = $request->validated();


    $category = Category::create(
      $data
    );


    return response()->json([
      'message' => 'Category successfully created',
      'category' => $category
    ], 201);
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

  /**
   * Get Category by id.
   *
   * @param int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function edit($id)
  {
    $category = Category::find($id);

    return response()->json([
      'category' => $category
    ], 201);
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

      $category->slug = null;
      $category->update($request->all());


      return response()->json([
        'message' => 'Category successfully updated',
        'category' => $category
      ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
      $products = Product::where('category_id', $category->id)->get();

      if ($products) {
        foreach ($products as $product) {
          $images = $product->load('images')->images;

          foreach ($images as $i) {
            $image = Image::find($i->id);
            Storage::delete($image->thumbnail);
            $image->delete();
          }
        }

        foreach ($products as $product) {
          $product->delete();
          $product->tags()->detach();
          $product->images()->detach();
        }

        $category->delete();

      }

      return response()->json([
        'message' => 'Category deleted successfully',
        'category' => $category
      ], 201);
    }
}
