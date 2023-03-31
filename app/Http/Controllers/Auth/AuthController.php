<?php

namespace App\Http\Controllers\Auth;

use App\ApiCode;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginUserRequest;
use App\Http\Requests\API\Auth\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => [
            'register',
            'login',
        ]]);
    }

    public function register(StoreUserRequest $request)
    {
        $input = $request->validated();
        $user = User::create($input);

        $token = auth()->login($user);
        $user->remember_token = $token;
        $user->save();
        return $this->sendResponse(
            [
                'token' => $token,
                'user' => User::findOrFail($user->id)
            ],
            'user created successfully',
            ApiCode::CREATED,
            0
        );
    }

    public function login(LoginUserRequest $request)
    {
        $input = $request->validated();
        if ($token = auth()
            ->attempt([
                'email' => $input['email'],
                'password' => $input['password']
            ])
        ) {
            $user = auth()->user();
            $user->remember_token = $token;
            $user->save();

            return  $this->sendResponse([
                'token' => $token,
                'user' => $user,
            ], "User successfully logged in",  ApiCode::SUCCESS, 0);
        } else {
            //if authentication is unsuccessfully, notice how I return json parameters
            return $this->sendResponse(
                null,
                "Invalid Phone or Password",
                ApiCode::BAD_REQUEST,
                1
            );
        }
    }
}
