<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function index()
  {

    return view('admin.pages.users', [

    ]);
  }

  /**
   * Paginate users
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function paginationUsers(Request $request)
  {

    $users = User::
      when($request->usersRole, function ($query, $usersRole) {
        if ($usersRole !== 0) {
          return User::whereRelation('roles', 'slug', $usersRole);
        }
      })
      ->orderBy($request->usersOrderBy, $request->usersDirection)->paginate($request->usersPerPage);

    $users->withPath('users/');
    $users->load('roles');


    return response()->json([
      'users' => $users,
    ], 201);
  }

  /**
   * Search users.
   * @param Request $request
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function searchUsers(Request $request)
  {
    $s = $request->s;
    $users = User::where('name', 'LIKE', "%{$s}%")->with('roles')->orderBy('name')->skip($request->length)->take(10)->get();

    return response()->json([
      'users' => $users,
    ], 201);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\User  $user
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
   */
  public function edit(User $user)
  {
    $user->load('roles');

    $roles = Role::all();


    return response()->json([
      'user' => $user,
      'roles' => $roles,
    ], 201);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * * @param  \App\Models\User  $user
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, User $user)
  {

    if ($request->userRoles) {
      $user->roles()->sync($request->userRoles);
    }

    return response()->json([
      'message' => 'You have successfully edited the user',
      'user' => $user,
    ], 201);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\User $user
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(User $user)
  {
    if (Auth::user()->id === $user->id) {
      return response()->json([
        'error' => 'You cannot delete yourself!'
      ], 405);
    }

    $user->delete();

    return response()->json([
      'message' => 'You have successfully delete the user',
    ], 201);
  }
}
