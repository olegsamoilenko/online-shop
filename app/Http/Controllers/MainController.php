<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;

use Illuminate\Http\Request;


class MainController extends Controller
{
  /**
   * Get Main page.
   *
   * @return view|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */

  public function index()
  {
    $categories = Category::all();
    $tag = Tag::first();
//    $products = '';
    if ($tag) {
      $products = $tag->products()->take(12)->with('images')->with('tags')->with('category')->get();
    } else {
      $tag = '';
      $products = '';
    }
    $categoryImages = [];
    for ($i = 1; $i <= count($categories); $i++) {
      array_push($categoryImages, Product::where('category_id', $i)->first()->images[0]);;
    }
    $images = collect($categoryImages);

    return view('main.pages.home')->with(['categories' => $categories, 'tag' => $tag, 'products' => $products, 'images' => $images]) ;
  }

  /**
   * Load popular products on main page.
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function getMorePopularProducts(Request $request)
  {
    $tag = Tag::first();

    $int = empty($request->id) ? 0 : $request->id;
    $products = Product::whereHas('tags', function ($query) use ($tag) {
      $query->where('title', $tag->title);
    })->where('id', '>', $int)->with('images')->with('tags')->with('category')->take(12)->get();

    return response()->json([
      'products' => $products,
    ], 201);
  }

  /**
   * Get Category page.
   *
   * @return view|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */

  public function categoryPage(Category $category)
  {

    return view('main.pages.category', ['category' => $category]);
  }

  /**
   * Pagination product on Category page.
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function paginationCategoryPage(Request $request)
  {
    $products = Product::where('category_id', $request->categoryId)->with('images')->with('tags')->with('category')->paginate(12);
    $products->withPath('/category/' . $request->slug);


    return response()->json([
      'products' => $products,
    ], 201);
  }

  /**
   * Get Product by id page.
   *
   * @return view|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */

  public function getProductById(Product $product)
  {
//    $product->price = number_format($product->price, 2, ',', ' ') . ' грн.';
    $category = Category::where('id', $product->category_id)->first();

    return view('main.pages.product', ['category' => $category, 'product' => $product->load('images')->load('tags')->load('category')]);
  }

  /**
   * Get Tag page.
   *
   * @return view|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */

  public function tagPage(Tag $tag)
  {

    return view('main.pages.tag', ['tag' => $tag]);
  }

  /**
   * Pagination product on Tag page.
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function paginationTagPage(Request $request)
  {
    $t = Tag::find($request->tagId);
    $products = $t->products()->with('images')->with('tags')->with('category')->paginate(12);
    $products->withPath('/tag/' . $request->slug);

    return response()->json([
      'products' => $products,
    ], 201);
  }

  /**
   * Get Info page.
   *
   * @return view|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */

  public function infoPage($info)
  {
    return view('main.pages.info', ['info' => $info]);
  }

  /**
   * Get Ordering page.
   *
   * @return view|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */

  public function orderingPage()
  {
    return view('main.pages.ordering');
  }

  /**
   * Get Search page.
   *
   * @return view|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */

  public function searchPage(Request $request)
  {
    $s = $request->s;
    $products = Product::where('title', 'LIKE', "%{$s}%")->with('tags')->with('images')->with('category')->orderBy('title')->take(12)->get();

    return view('main.pages.search-result', ['products' => $products]);
  }

  public function search(Request $request)
  {
    $s = $request->s;
    $products = Product::where('title', 'LIKE', "%{$s}%")->with('tags')->with('images')->with('category')->orderBy('title')->skip($request->length)->take(12)->get();

    return response()->json([
      'products' => $products,
    ], 201);
  }
}
