<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Controllers\Api\ApiController;

class AuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }

    public function loginPage()
    {
        return view('welcome');
    }

    /**
     * @OA\Post(
     *  path="/api/auth/login",
     *  summary="Login Function A User",
     *  tags={"Auth"},
     *  @OA\RequestBody(
     *  @OA\JsonContent(),
     *  @OA\MediaType(
     *      mediaType="multipart/form-data",
     *      @OA\Schema(
     *          type="object",
     *          required={"email", "password"},
     *          @OA\Property(
     *              property="email",
     *              type="email"
     *          ),
     *          @OA\Property(
     *              property="password"
     *          )
     *      )
     *   )
     *  ),
     *  @OA\Response(response="200", description="Login Has Successfully"),
     *  @OA\Response(response="422", description="Validation Error"),
     *  @OA\Response(response="500", description="Something Went Wrong"),
     * )
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->validated('email'), 'password' => $request->validated('password')])) {
            $user   = Auth::user();
            $token  = $user->token();
            $type   = 'Bearer';
            $data   = [
                'user'  => $user,
                'token' => $token,
                'type'  => $type
            ];

            return $this->responseSuccessNoStucture($data,'Login Has Successfully');
        }

        return $this->responseError(message:'User password not match on our database');
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        return $this->responseSuccessNoStucture(message:'Logout Has Successfully');
    }
}
