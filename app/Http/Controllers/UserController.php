<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $isAdmin;

    public function __construct()
    {
      $authUser = \JWTAuth::parseToken()->authenticate();
      if($authUser->role=='admin'){
        $this->isAdmin = true;
      } else {
        $this->isAdmin = false;
      }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if($this->isAdmin){
        return UserResource::collection(User::all());
      } else{
        return response()->json(['message' => 'Insufficient rights'], 403);
        // return abort(403, 'Forbidden');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($this->isAdmin){
        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password)
        ]);

        return new UserResource($user);
      } else{
        return response()->json(['message' => 'Insufficient rights'], 403);
        // return abort(403, 'Forbidden');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $connectedUser = Auth::user();
      if($this->isAdmin || ($connectedUser && ($connectedUser->id==$id))){
        $user = User::findOrFail($id);
        return new UserResource($user);
      } else {
        return response()->json(['message' => 'Insufficient rights'], 403);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $user = User::findOrFail($id);
      $user->update($request->all());

      return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if($this->isAdmin){
        User::destroy($id);
        return response()->json(null, 204);
      } else{
        return response()->json(['message' => 'Insufficient rights'], 403);
        // return abort(403, 'Forbidden');
      }
    }
}
