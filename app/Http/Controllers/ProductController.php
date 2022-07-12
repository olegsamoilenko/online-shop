<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function index()
  {
    $products = Product::all();
    $categories = Category::all();
    $tags = Tag::all();

    return view('admin.pages.products', [
      'products' => $products,
      'categories' => $categories,
      'tags' => $tags,
    ]);
  }

  /**
   * Paginate products
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function paginationProduct(Request $request)
  {

    $products = Product::
    when($request->productsTag, function ($query, $productsTag) {
      if ($productsTag !== 'all') {
        $tag = Tag::where('id', $productsTag)->first();
        return $tag->products();
      }
    })
      ->when($request->productsCategory, function ($query, $productsCategory) {
        if ($productsCategory !== 'all') {
          return $query->where('category_id', $productsCategory);
        }
      })
      ->when($request->isActive, function ($query, $isActive) {
        if ($isActive !== 'all') {
          return $query->where('is_active', $isActive);
        }
      })
      ->when($request->productsAvailability, function ($query, $productsAvailability) {
        if ($productsAvailability !== 'all') {
          return $query->where('is_available', $productsAvailability);
        }
      })->orderBy($request->productsOrderBy, $request->productsDirection)->paginate($request->productsPerPage);

    $products->withPath('products/');
    $products->load('category');
    $products->load('tags');
    $products->load('images');


    return response()->json([
      'products' => $products,
    ], 201);
  }

  /**
   * Search users.
   * @param Request $request
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function searchProducts(Request $request)
  {
    $s = $request->s;
    $products = Product::where('title', 'LIKE', "%{$s}%")->with('images')->with('tags')->orderBy('title')->skip($request->length)->take(10)->get();

    return response()->json([
      'products' => $products,
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
   * @param \App\Http\Requests\StoreProductRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(StoreProductRequest $request)
  {


    $data = $request->validated();
//dd($data);

    $product = Product::create(
      $data
    );
    if ($request->tags) {
      $product->tags()->sync(explode(',', $request->tags));
    }


    if ($request->images) {
      $product->images()->sync(explode(',', implode(',', $this->addImages($request->images, $product->id))));
    }

    return response()->json([
      'message' => 'Product added successfully',
      'product' => $product
    ], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Product $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Product $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \App\Http\Requests\UpdateProductRequest $request
   * @param \App\Models\Product $product
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(UpdateProductRequest $request, Product $product)
  {

    $data = $request->validated();

    $product->update($data);

    if ($request->removedImages) {
      foreach (explode(',', $request->removedImages) as $id) {
        $image = Image::find($id);
        Storage::delete($image->thumbnail);
        $image->delete();
        $product->images()->detach($id);
      }
    }

    if ($request->images) {
      $product->images()->attach(explode(',', implode(',', $this->addImages($request->images, $product->id))));
    }


    if ($request->tags) {
      $product->tags()->sync(explode(',', $request->tags));
    } else {
      $product->tags()->detach();
    }


    return response()->json([
      'message' => 'Product updated successfully',
      'product' => $product,
    ], 201);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Product $product
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(Product $product)
  {
    foreach ($product->images as $i) {
      $image = Image::find($i->id);

      Storage::delete('public/images/products/' . $image->thumbnail);
      $image->delete();
    }

    $product->delete();

    $product->tags()->detach();
    $product->images()->detach();

    return response()->json([
      'message' => 'Product removed successfully',
    ], 201);
  }

  /**
   * Upload image to folder. Add image path to table.
   *
   * @param $img
   * @return array
   */

  private function addImages($img, $prodId)
  {
    $images = [];
    foreach ($img as $image) {

      $path = $image->store("public/images/products/");

      $image = new Image;
      $image->thumbnail = substr(strrchr($path, '/'), 1);
      $image->save();

      array_push($images, $image->id);
    }
    return $images;
  }
}
