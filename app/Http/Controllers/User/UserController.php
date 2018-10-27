<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User as User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    //
    public function index(Request $r) 
    {
    }

    public function login() 
    {
      if (Auth::attempt(
          [
              'email'    => request('email'), 
              'password' => request('password')
          ])
      ) {
          $user = Auth::user();

          $success['token'] = $user->createToken('MyApp')->accessToken;

          return response()->json(
              ['success' => $success],
              $this->successStatus
          );

      } else {
          return response()->json(
              ['error' => 'Unauthorised'],
              401
          );
      }
    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => 'required',
                'email'                 => 'required|email',
                'password'              => 'required',
                'confirmation_password' => 'required|same:password'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = $request->all();

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $success['token'] = $user->createToken('novelite')->accessToken;
        $success['name']  = $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }
}
