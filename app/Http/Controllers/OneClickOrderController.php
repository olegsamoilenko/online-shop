<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOneClickOrderRequest;
use App\Http\Requests\StoreOneClickOrderRequest;
use App\Models\OneClickOrder;
use Illuminate\Http\Request;

class OneClickOrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function index()
  {
    $oneClickOrders = OneClickOrder::all()->load('products');

    return view('admin.pages.one-click-orders', [
      'oneClickOrders' => $oneClickOrders,
    ]);
  }

  /**
   * Paginate orders
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function paginationOrder(Request $request)
  {

    $orders = OneClickOrder::
    when($request->oneClickOrdersStatus, function ($query, $oneClickOrdersStatus) {
      if ($oneClickOrdersStatus !== 'all') {
        return $query->where('status', $oneClickOrdersStatus);
      }
    })->
    when($request->oneClickOrdersPayment, function ($query, $oneClickOrdersPayment) {
      if ($oneClickOrdersPayment !== 'all') {
        return $query->where('paid', $oneClickOrdersPayment);
      }
    })->
    when($request->oneClickOrdersConfirmation, function ($query, $oneClickOrdersConfirmation) {
      if ($oneClickOrdersConfirmation !== 'all') {
        return $query->where('no_confirmation_call', $oneClickOrdersConfirmation);
      }
    })->orderBy($request->oneClickOrdersOrderBy, $request->oneClickOrdersDirection)->paginate($request->oneClickOrdersPerPage);

    $orders->load(['products' => function ($query) {
      $query->with('images')->with('category');
    }]);
    $orders->withPath('one-click-orders/');


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
   * @param \App\Http\Requests\StoreOneClickOrderRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(StoreOneClickOrderRequest $request)
  {

    $data = $request->validated();

    $order = OneClickOrder::create(
      $data
    );



    if ($request->productId) {
      $order->products()->attach($request->productId);
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
   * Update the specified resource in storage.
   *
   * @param \App\Http\Requests\UpdateOneClickOrderRequest $request
   * @param \App\Models\OneClickOrder $order
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(UpdateOneClickOrderRequest $request, OneClickOrder $order)
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
   * @param \App\Models\OneClickOrder $order
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(OneClickOrder $order)
  {
    $order->delete();

    $order->products()->detach();

    return response()->json([
      'message' => 'Order successfully deleted',
    ], 201);
  }
}
