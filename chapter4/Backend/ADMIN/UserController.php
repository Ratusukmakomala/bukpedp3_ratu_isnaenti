<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/api/admin/user/",
     *     summary="Get User Login",
     *     tags={"Admin/User"},
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function __invoke(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $data = [
            'user'  => $user,
            'token' => $user->token()
        ];

        return $this->responseSuccessNoStucture($data, 'Get User Login');
    }
}
