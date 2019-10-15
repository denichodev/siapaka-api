<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

use Log;

class AuthController extends RestController
{
  /**
   * login API
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    $input = $request->all();
    $validator = Validator::make($input, [
      'email' => 'required|email',
      'password' => 'required',
    ]);
    if ($validator->fails()) {

      return $this->badRequestResponse($validator->errors());
    }
    $credentials = $request->only(['email', 'password']);
    if (Auth::attempt($credentials)) {
      $user = Auth::user();

      if ($user->role_id == 'ADM') {
        $success['token'] = $user->createToken('siapaka-token', ['*'])->accessToken;
      } else if ($user->role_id == 'KG') {
        $success['token'] = $user->createToken('siapaka-token', [
          'read-supplier',
          'read-doctor'
        ])->accessToken;
      } else if ($user->role_id == 'KAS') {
        $success['token'] = $user->createToken('siapaka-token', [
          'read-supplier',
          'read-doctor'
        ])->accessToken;
      } else if ($user->role_id == 'APT') {
        $success['token'] = $user->createToken('siapaka-token', [
          'read-supplier',
          'read-doctor'
        ])->accessToken;
      }


      return $this->response((['success' => $success]));
    } else {
      return $this->response(['error' => 'Unauthorized'], 401);
    }
  }
}
