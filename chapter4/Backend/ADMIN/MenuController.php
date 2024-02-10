<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Menu;
use App\Traits\HasImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\StoreMenuRequest;
use App\Http\Requests\Api\UpdateMenuRequest;

class MenuController extends ApiController
{
    use HasImage;

    public function __construct(public Menu $model)
    {

    }

    /**
     * @OA\Get(
     *     path="/api/admin/menu/",
     *     summary="Get All Menu",
     *     tags={"Admin/Menu"},
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function index()
    {
        $menus = $this->model->latest()->get();
        return $this->responseSuccessNoStucture($menus, 'Get all menus');
    }

    /**
     * @OA\Post(
     *     path="/api/admin/menu",
     *     summary="Create Menu",
     *     tags={"Admin/Menu"},
     *     @OA\RequestBody(
     *      @OA\JsonContent(),
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              required={"image", "name", "desc", "price", "type"},
     *              @OA\Property(
     *                  property="image",
     *                  type="file"
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="desc",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="price",
     *                  type="numeric"
     *              ),
     *              @OA\Property(
     *                  property="type",
     *                  type="string"
     *              ),
     *          )
     *      )
     *  ),
     *  @OA\Response(response="200", description="Order Status Has Been Updated"),
     *  @OA\Response(response="422", description="Validation Error"),
     *  @OA\Response(response="500", description="Something Went Wrong"),
     *  security={{"bearerAuth": {}}}
     * )
     */
    public function store(StoreMenuRequest $request)
    {
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $this->uploadImage($request->validated('image'),'menu');
                $this->model->image = $request->validated('image')->hashName();
            }
            $this->model->name = $request->validated('name');
            $this->model->desc = $request->validated('desc');
            $this->model->price = $request->validated('price');
            $this->model->type = $request->validated('type');
            $this->model->save();

            DB::commit();
            return $this->responseSuccessNoStucture(message:'Menu Has Been Created');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/admin/menu/{menu}",
     *     summary="Get Menu",
     *     tags={"Admin/Menu"},
     *     @OA\Parameter(
     *      name="menu",
     *      in="path",
     *      required=true,
     *      description="The unique identifier of the menu.",
     *      @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function show(Menu $menu)
    {
        return $this->responseSuccessNoStucture($menu,'Get detail menu');
    }

    /**
     * @OA\Post(
     *     path="/api/admin/menu/{menu}",
     *     summary="Update Menu",
     *     tags={"Admin/Menu"},
     *     @OA\Parameter(
     *      name="menu",
     *      in="path",
     *      required=true,
     *      description="The unique identifier of the menu.",
     *      @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *      @OA\JsonContent(),
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              required={"image", "name", "desc", "price", "type", "_method"},
     *              @OA\Property(
     *                  property="image",
     *                  type="file"
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="desc",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="price",
     *                  type="numeric"
     *              ),
     *              @OA\Property(
     *                  property="type",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="_method",
     *                  type="string"
     *              ),
     *          )
     *      )
     *  ),
     *  @OA\Response(response="200", description="Order Status Has Been Updated"),
     *  @OA\Response(response="422", description="Validation Error"),
     *  @OA\Response(response="500", description="Something Went Wrong"),
     *  security={{"bearerAuth": {}}}
     * )
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $this->removeImage($menu->image, 'menu');
                $this->uploadImage($request->validated('image'),'menu');
                $menu->image = $request->validated('image')->hashName();
            }
            $menu->name = $request->validated('name');
            $menu->desc = $request->validated('desc');
            $menu->price = $request->validated('price');
            $menu->type = $request->validated('type');
            $menu->save();
            DB::commit();
            return $this->responseSuccessNoStucture(message:'Menu Has Been Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/admin/menu/{menu}",
     *     summary="Delete Menu",
     *     tags={"Admin/Menu"},
     *     @OA\Parameter(
     *      name="menu",
     *      in="path",
     *      required=true,
     *      description="The unique identifier of the menu.",
     *      @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function destroy(Menu $menu)
    {
        DB::beginTransaction();
        try {
            $this->removeImage($menu->image, 'menu');
            $menu->delete();
            DB::commit();
            return $this->responseSuccessNoStucture(message:'Menu Has Been Deleted');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }
}
