<?php

namespace App\Http\Controllers\Api\Home;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;

class MenuController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/api/home/menu",
     *     summary="Get All Menu",
     *     tags={"Home"},
     *     @OA\Response(response="200", description="Success"),
     * )
     */
    public function __invoke(Request $request)
    {
        $menus = Menu::whereType($request->type)->latest()->get();
        return $this->responseSuccessNoStucture($menus,'Get all menus');
    }
}
