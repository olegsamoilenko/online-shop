<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function index()
  {
    $orders = Order::all()->load('products');

    return view('admin.pages.orders', [
      'orders' => $orders,
    ]);
  }

  /**
   * Paginate orders
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function paginationOrder(Request $request)
  {

    $orders = Order::
    when($request->ordersStatus, function ($query, $ordersStatus) {
      if ($ordersStatus !== 'all') {
        return $query->where('status', $ordersStatus);
      }
    })->
    when($request->ordersPayment, function ($query, $ordersPayment) {
      if ($ordersPayment !== 'all') {
        return $query->where('paid', intval($ordersPayment));
      }
    })->
    when($request->ordersConfirmation, function ($query, $ordersConfirmation) {
      if ($ordersConfirmation !== 'all') {
        return $query->where('no_confirmation_call', (int)$ordersConfirmation);
      }
    })->orderBy($request->ordersOrderBy, $request->ordersDirection)->paginate($request->ordersPerPage);

    $orders->load(['products' => function ($query) {
      $query->with('images')->with('category');

    }]);
    $orders->withPath('orders/');


    return response()->json([
      'orders' => $orders,
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
   * @param \App\Http\Requests\StoreOrderRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(StoreOrderRequest $request)
  {
    $data = $request->snakeCase();

    $order = Order::create(
      $data
    );

    foreach ($request->products as $req) {
      $order->products()->attach($req[0], ['count' => $req[1][1]]);
    }

    return response()->json([
      'message' => 'Order added successfully',
      'order' => $order
    ], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Order $order
   * @return \Illuminate\Http\Response
   */
  public function show(Order $order)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function edit(Request $request)
  {

    $order = Order::find($request->id)->load('products');
    $products = Order::find($request->id)->products()->with('images')->with('category')->get();
    foreach ($products as $product) {
      $product['count'] = $product->pivot->count;
    }

    return response()->json([
      'order' => $order,
      'products' => $products,
    ], 201);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \App\Http\Requests\UpdateOrderRequest $request
   * @param \App\Models\Order $order
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(UpdateOrderRequest $request, Order $order)
  {

    $data = $request->validated();

    $order->update($data);

    $order->products()->detach();
    foreach ($request->products as $req) {
      $order->products()->attach($req[0], ['count' => $req[1][1]]);
    }


    return response()->json([
      'message' => 'Order updated successfully',
      'order' => $order->load('products')
    ], 201);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Order $order
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(Order $order)
  {
    $order->delete();

    $order->products()->detach();

    return response()->json([
      'message' => 'Order successfully deleted',
    ], 201);
  }
}
