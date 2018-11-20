<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Authenticator\Authenticator;
use Illuminate\Auth\AuthenticationException;

use App\Models\User as User;
use Illuminate\Support\Facades\Auth;

use Validator;
use Carbon\Carbon;

class AdminController extends Controller
{
    private $authenticator;

    public function __construct(Authenticator $auth)
    {
        $this->authenticator = $auth;
    }

    public function login(Request $request) 
    {
        $credentials = array_values($request->only('email', 'password', 'provider'));

        dump($credentials);

        if (!$user = $this->authenticator->attempt(...$credentials)) {
            throw new AuthenticationException();
            //return response()->json(
            //    ['error' => 'Unauthorised'],
            //    401
            //);
        }

        $token = $user->createToken('Novelite-App');

        $token->token->expires_at = Carbon::now()->addWeeks(1);
        $token->token->save();

        $success['access_token'] = $token->accessToken;
        $success['token_type']   = 'Bearer';
        $success['expires_at']   = Carbon::parse($token->token->expires_at)->toDateTimeString();


        return response()->json(
            ['success' => $success],
            $this->successStatus
        );

        //Old Code

        //if (Auth::attempt(
        //    [
        //        'email'    => request('email'), 
        //        'password' => request('password')
        //    ])
        //) {
        //    $user        = Auth::user();
        //    $tokenResult = $user->createToken('Novelite');
        //    $token       = $tokenResult->token;

        //    $token->expires_at = Carbon::now()->addWeeks(1);
        //    $token->save();

        //    $success['access_token'] = $tokenResult->accessToken;
        //    $success['token_type']   = 'Bearer';
        //    $success['expires_at']   = Carbon::parse($token->expires_at)->toDateTimeString();
        //    $success['id']           = Auth::id();

        //    return response()->json(
        //        ['success' => $success],
        //        $this->successStatus
        //    );

        //} else {
        //    return response()->json(
        //        ['error' => 'Unauthorised'],
        //        401
        //    );
        //}
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

    /*
     * Below is the codes where authentications were needed
     */

    public function logout(Request $request) {
        $user = $request->user();
        $user->token()->revoke();

        return '200 logged out';
    }

    public function updateProfile($request)
    {
        $modelUser = new User();

        $user = $request->user();

        $modelUser->update($request);

        return 200;
    }
}
