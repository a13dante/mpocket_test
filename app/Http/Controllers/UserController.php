<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $request = request('user_ids');
        // $users = User::whereIn('id', $request)->get();
        //
        // //test
        // return response()->json($request);
    }

    public function show($id)
    {

      $user = User::findOrFail($id);

      if(!empty(request('fmt')))
      {
        return collect($user)->join(',');
      }

        return response()->json($user, '200');
    }

    public function getUsersByIds()
    {
      $request = request('id');
      $users = User::whereIn('id', $request)->get();

      if(!empty(request('fmt')))
      {
        $temp  = '';
        foreach ($users as $key => $user) {
            $temp .= collect($user)->join(',');
        }
        return $temp;
      }

      return response()->json($users);
    }

}
