<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\SubscribeRequest;

class SubscribeController extends Controller
{
  /**
   * Subscribe user.
   *
   * @param SubscribeRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   */


  public function subscribe(SubscribeRequest $request)
  {
    $data = $request->validated();

    Subscription::create(
      $data
    );

    return response()->json([
      'message' => 'You have successfully subscribed to our newsletter',
    ], 201);
  }
}
